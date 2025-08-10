import { ICurrency } from "@/shared/models/interfaces/currency";
import { ExchangeApiService } from "./api";
import { ExchangeView } from "./view";
import { ExchangeState } from "./state";
import {
    DefaultPair,
    getCurrentLanguage,
    getDefaultCurrencies,
    parseDefaultSelectionFromURL,
    safeCall,
} from "./utils";
import { RateRefresher } from "./refresher";
import { SelectedCurrency, Side } from "./types";
import { EventEmitter } from "./events";

export class ExchangeController extends EventEmitter {
    private view: ExchangeView;
    private state = new ExchangeState();
    private defaultPair?: DefaultPair;
    private refresher: RateRefresher;
    private lang = getCurrentLanguage();

    constructor(view: ExchangeView, defaultPair?: DefaultPair) {
        super();
        this.view = view;
        this.defaultPair = defaultPair;
        this.refresher = new RateRefresher(
            5_000,
            async (send, get) => {
                await this.updatePair(send, get, this.state.isLocked() ? Side.Get : Side.Send, true);
            },
            (time) => {
                this.view.updateTimer(time);
            }
        );
    }

    async init() {
        try {
            this.registerCallbacks();

            const currencies = await ExchangeApiService.getCurrencies();
            var sendCurrencies = await ExchangeApiService.getSendCurrencies();

            if (!currencies.length) return false;
            if (!sendCurrencies.length) sendCurrencies = currencies;
            this.state.setCurrencies(currencies);
            this.state.setSendCurrencies(sendCurrencies);
            const defaultSettings = parseDefaultSelectionFromURL();
            const { send, get } = getDefaultCurrencies(
                currencies,
                defaultSettings,
                this.defaultPair
            );
            await this.renderCurrencies(sendCurrencies, currencies);
            await this.updateSettings(send, get);
            await this.updatePair(send, get);
            await this.renderUSDTHint();
            await this.renderGlobalCourse();
            this.restartRefresher(send, get);
            return true;
        } catch (error) {
            this.view.showError("Ошибка инициализации");
        }
        return false;
    }
    private registerCallbacks() {
        this.view.setCallbacks({
            onInputChange: async (val, isSend) => {
                this.emit("inputChange", val, isSend);
                await this.onInputChange(val, isSend);
            },
            onSubmit: async (e) => {
                await this.onSubmit(e);
            },
            onInputSearchChange: async (query, isSend) => {
                await this.onInputSearchChange(query, isSend);
                this.emit("inputSearchChange", query, isSend);
            },
            onCurrencySelect: async (currency, isSend) => {
                await this.onCurrencySelect(currency, isSend);
                this.emit("currencySelect", currency, isSend);
            },
            onLock: async (locked) => {
                await this.onLock(locked);
                this.emit("onLock", locked);
            },
            onTabSelect: async (tab, isSend) => {
                await this.onTabSelect(tab, isSend);
                this.emit("tabSelect", tab, isSend);
            },
            onReverse: async () => {
                await this.onReverse();
                this.emit("reverse");
            },
        });
    }

    private restartRefresher(send: SelectedCurrency, get: SelectedCurrency) {
        this.refresher.stop();
        this.refresher.start(send, get);
    }

    private getCurrentPair(): {
        send: SelectedCurrency;
        get: SelectedCurrency;
    } | null {
        const send = this.state.getSelectedSend();
        const get = this.state.getSelectedGet();
        if (!send || !get) return null;
        return { send, get };
    }

    private async withRefresherRestart(action: () => Promise<void>) {
        this.refresher.stop();
        await action();
        const pair = this.getCurrentPair();
        if (pair) {
            this.restartRefresher(pair.send, pair.get);
        }
    }

    private async applyNewPair(send: SelectedCurrency, get: SelectedCurrency) {
        this.state.selectSendCurrency(send);
        this.state.selectGetCurrency(get);
        await this.updatePair(send, get);
        await this.renderGlobalCourse();
    }

    private async renderGlobalCourse() {
        const pair = this.getCurrentPair();
        if (!pair) return;

        const estimate = await safeCall(
            () =>
                ExchangeApiService.getEstimate(
                    pair.send.currency.name,
                    pair.get.currency.name,
                    1
                ),
            "Ошибка при получении глобального курса"
        );

        if (estimate) {
            const fromString = `1 ${pair.send.currency.name}`;
            const toString = `${estimate.amount} ${pair.get.currency.name}`;

            this.view.updateGlobalCourse(fromString, toString);

            this.emit("onUpdateGlobalCourse", fromString, toString);
        }
    }

    private async updatePair(
        send: SelectedCurrency,
        get: SelectedCurrency,
        side: Side = Side.Send,
        renderOnlyTarget = false
    ) {
        await this.updateSettings(send, get);
        const { from, to } = await this.updateAmounts(send, get, side);

        this.state.selectSendCurrency(from);
        this.state.selectGetCurrency(to);
        if (renderOnlyTarget) {
            const isSend = side === Side.Send;
            this.setSelected(isSend ? to : from, !isSend);
            this.emit("onSetSelected", isSend ? from : to, isSend);
        } else {
            this.renderSelected();
        }
    }
    private setSelected(selected: SelectedCurrency, isSend: boolean) {
        this.view.setSelected(selected, isSend);
        this.emit("onSetSelected", selected, isSend);
    }
    private async updateAmounts(
        send: SelectedCurrency,
        get: SelectedCurrency,
        leadingSide: Side = Side.Send
    ) {
        const from = { ...send };
        const to = { ...get };
        const isSend = leadingSide === Side.Send;
    
        const getLeadingAmount = () => (isSend ? from.amount : to.amount);
        const setLeadingAmount = (value: number) => {
            if (isSend) from.amount = value;
            else to.amount = value;
        };
        const setCounterAmount = (value: number) => {
            if (isSend) to.amount = value;
            else from.amount = value;
        };
    
        let requestAmount = getLeadingAmount();
    
        if (!requestAmount) {
            const settings = this.state.getSettings()?.data;
            if (!settings) return { from, to }; 
    
            setLeadingAmount(settings.max_amount);  
            requestAmount = settings.min_amount;   
        }
    
        const estimate = await safeCall(
            () =>
                ExchangeApiService.getEstimate(
                    from.currency.name,
                    to.currency.name,
                    requestAmount!,
                    isSend ? 0 : 1
                ),
            "Ошибка при получении курса обмена",
            () => this.view.showError("Не удалось получить курс обмена")
        );
    
        if (estimate) {
            setCounterAmount(estimate.amount);
        } else {
            from.amount = 0;
            to.amount = 0;
        }
    
        return { from, to };
    }
    
    private async updateSettings(from: SelectedCurrency, to: SelectedCurrency) {
        const settings = await safeCall(
            () =>
                ExchangeApiService.getCurrencySettings(
                    from.currency.name,
                    to.currency.name
                ),
            "Ошибка при получении минимальной суммы"
        );

        if (settings) {
            this.emit("updateSettings", settings);
            this.state.setSettings(settings);
        }
    }

    private async renderUSDTHint() {
        const send = this.state.getSelectedSend();
        if (send && send.amount) {
            const result = await safeCall(
                () =>
                    ExchangeApiService.getUSDTERC(
                        send.currency.name,
                        send.amount
                    ),
                "Ошибка при получении подсказки USDT"
            );

            if (result) {
                this.view.updateUSDTHint(result.amount);
            }
        }
    }

    private renderSelected() {
        const pairs = [
            { currency: this.state.getSelectedSend(), isSend: true },
            { currency: this.state.getSelectedGet(), isSend: false },
        ];

        pairs.forEach(({ currency, isSend }) => {
            if (currency) this.setSelected(currency, isSend);
        });
    }

    private async renderCurrencies(sendCurrencies: ICurrency[] ,currencies: ICurrency[]) {
        await Promise.all([
            this.view.updateCurrencyList(sendCurrencies, true),
            this.view.updateCurrencyList(currencies, false),
            this.view.updateTabList(sendCurrencies, true),
            this.view.updateTabList(currencies, false),
        ]);
    }

    async onTabSelect(tab: string, isSend: boolean) {
        const currencies = isSend ? this.state.getSendCurrencies() : this.state.getCurrencies();
        const normalizedTab = tab?.toLowerCase();

        const filtered =
            normalizedTab && normalizedTab !== "all"
                ? currencies.filter(
                      (c) => c.tag.toLowerCase() === normalizedTab
                  )
                : currencies;

        await this.view.updateCurrencyList(filtered, isSend);
    }

    async onInputSearchChange(query: string, isSend: boolean) {
        const currencies = isSend ? this.state.getSendCurrencies() : this.state.getCurrencies();

        const filtered = currencies.filter((c) =>
            c.data.titles[this.lang].toLowerCase().includes(query.toLowerCase())
        );

        await this.view.updateCurrencyList(filtered, isSend);
        await this.view.updateTabList(this.state.getSendCurrencies(), true);
        await this.view.updateTabList(this.state.getCurrencies(), false);
    }

    async onInputChange(val: number, isSend: boolean) {
        await this.withRefresherRestart(async () => {
            const pair = this.getCurrentPair();
            if (!pair) return;

            if (isSend) {
                pair.send.amount = val;
                await this.updatePair(pair.send, pair.get, Side.Send, true);
            } else {
                pair.get.amount = val;
                await this.updatePair(pair.send, pair.get, Side.Get, true);
            }

            await this.renderUSDTHint();
        });
    }

    async onCurrencySelect(currency: ICurrency, isSend: boolean) {
        await this.withRefresherRestart(async () => {
            const pair = this.getCurrentPair();
            if (!pair) return;

            const selected = { currency, amount: null };
            const newSend = isSend ? selected : pair.send;
            const newGet = isSend ? pair.get : selected;

            await this.applyNewPair(newSend, newGet);
        });
    }

    async onReverse() {
        await this.withRefresherRestart(async () => {
            const pair = this.getCurrentPair();
            if (!pair) return;
    
            const sendCurrencies = this.state.getSendCurrencies();
            if (!sendCurrencies?.length) return;
    
            const potentialSend = { ...pair.get };
    
            const existsInSendList = sendCurrencies.some(
                c => c.name === potentialSend.currency.name
            );
    
            if (!existsInSendList) {
                this.view.showError("Эта валюта недоступна для отправки.");
                return;
            }
    
            const newGet = { ...pair.send };
    
            await this.applyNewPair(potentialSend, newGet);
        });
    }
    
    async onSubmit(e: JQuery.ClickEvent<HTMLElement>) {
        const send = this.state.getSelectedSend();
        const get = this.state.getSelectedGet();
        const settings = this.state.getSettings();
        const settingsData = settings?.data;


        if (!send || !get || send.amount == null || get.amount == null) {
            this.view.showError("Пожалуйста, заполните все необходимые поля.");
            return false;
        }

        if (
            settingsData &&
            (send.amount < settingsData.min_amount || send.amount > settingsData.max_amount)
        ) {
            this.view.showError("Сумма вне допустимого диапазона.");
            return false;
        }


        this.emit("onSubmit", e, send, get);
        return true;
    }
    async onLock(locked: boolean) {
        this.state.setLocked(locked);
    }
}
