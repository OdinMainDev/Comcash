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
import { SelectedCurrency } from "./types";
import { EventEmitter } from "./events";

enum Side {
  Send = "send",
  Get = "get",
}

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
                await this.updatePair(send, get, Side.Send, true);
            },
            (time) => {
                this.view.updateTimer(time);
            }
        );
    }

    async init() {
        try {
            this.registerCallbacks();

            const currencies = await safeCall(
                () => ExchangeApiService.getCurrencies(),
                "Не удалось загрузить список валют",
                () => this.view.showError("Не удалось загрузить список валют")
            );
            if (!currencies) return;

            this.state.setCurrencies(currencies);

            const defaultSettings = parseDefaultSelectionFromURL();
            const { send, get } = getDefaultCurrencies(
                currencies,
                defaultSettings,
                this.defaultPair
            );

            await this.renderCurrencies(currencies);
            await this.updateSettings(send, get);
            await this.updatePair(send, get);
            await this.renderUSDTHint();
            await this.renderGlobalCourse();
            this.restartRefresher(send, get);
            
        } catch (error) {
            this.view.showError("Ошибка инициализации");
        }
    }
    private registerCallbacks() {
      this.view.setCallbacks({
        onInputChange: async (val, isSend) => {
          this.emit("inputChange", val, isSend);
          await this.onInputChange(val, isSend);
        },
        onSubmit: async (e) => {
          this.emit("onSubmit", e);
          await this.onSubmit(e);
        },
        onInputSearchChange: async (query, isSend) => {
          this.emit("inputSearchChange", query, isSend);
          await this.onInputSearchChange(query, isSend);
        },
        onCurrencySelect: async (currency, isSend) => {
          this.emit("currencySelect", currency, isSend);
          await this.onCurrencySelect(currency, isSend);
        },
        onTabSelect: async (tab, isSend) => {
          this.emit("tabSelect", tab, isSend);
          await this.onTabSelect(tab, isSend);
        },
        onReverse: async () => {
          this.emit("reverse");
          await this.onReverse();
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

            this.view.updateGlobalCourse(
              fromString,
              toString
            );

            this.emit(
              "onUpdateGlobalCourse", 
              fromString,
              toString
            )
        }
    }

    private async updatePair(
        send: SelectedCurrency,
        get: SelectedCurrency,
        side: Side = Side.Send,
        renderOnlyTarget = false
    ) {

        const { from, to, amountChanged } = await this.updateAmounts(send, get, side);

        this.state.selectSendCurrency(from);
        this.state.selectGetCurrency(to);
        if (renderOnlyTarget && !amountChanged) {
            const isSend = side === Side.Send;
            this.setSelected(isSend ? to : from, !isSend);
        } else {
            this.renderSelected();
        }
    }
    private setSelected(selected: SelectedCurrency, isSend: boolean) {
      this.view.setSelected(selected, !isSend);
      this.emit("onSetSelected", selected, isSend);
    }
    private async updateAmounts(
      send: SelectedCurrency,
      get: SelectedCurrency,
      leadingSide?: Side
  ) {
      const activeSide = leadingSide ?? Side.Send;
  
      let from = { ...send };
      let to = { ...get };
      const settingsFrom = activeSide === Side.Send ? from : to;
      const settingsTo = activeSide === Side.Send ? to : from;
  
      let requestAmount;
      if (activeSide === Side.Send) {
          requestAmount = from.amount;
      } else {
          requestAmount = to.amount;
      }
  
      if (!requestAmount || !this.state.isCurrentSettings(settingsFrom, settingsTo)) {
          await this.updateSettings(from, to);
      }
  
      if (activeSide === Side.Send) {
          from = this.validateAmount(from);
          requestAmount = from.amount;
      } else {
          to = this.validateAmount(to);
          requestAmount = to.amount;
      }
  
      const originalAmount = activeSide === Side.Send ? send.amount : get.amount;
      const amountChanged = originalAmount !== requestAmount;
  
      const estimate = await safeCall(
          () =>
              ExchangeApiService.getEstimate(
                  from.currency.name,
                  to.currency.name,
                  requestAmount!,
                  activeSide === Side.Send ? 0 : 1
              ),
          "Ошибка при получении курса обмена",
          () => this.view.showError("Не удалось получить курс обмена")
      );
  
      if (estimate) {
          if (activeSide === Side.Send) {
              to.amount = estimate.amount;
          } else {
              from.amount = estimate.amount;
          }
      } else {
          from.amount = 0;
          to.amount = 0;
      }
  
      return { from, to, amountChanged };
  }
  
    private validateAmount(from: SelectedCurrency): SelectedCurrency {
        const settings = this.state.getSettings()?.data;
        if (!settings) return from;

        const min = settings.min_amount;
        const max = settings.max_amount;

        if (!from.amount) {
            from.amount = min;
        } else if (from.amount < min) {
            from.amount = min;
            this.view.showError(`Минимальная сумма для обмена: ${min}`);
        } else if (from.amount > max) {
            from.amount = max;
            this.view.showError(`Максимальная сумма для обмена: ${max}`);
        }
        return from;
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

        if (settings)  {
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

    private async renderCurrencies(currencies: ICurrency[]) {
        await Promise.all([
            this.view.updateCurrencyList(currencies, true),
            this.view.updateCurrencyList(currencies, false),
            this.view.updateTabList(currencies, true),
            this.view.updateTabList(currencies, false),
        ]);
    }

    async onTabSelect(tab: string, isSend: boolean) {
        const currencies = this.state.getCurrencies();
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
        const currencies = this.state.getCurrencies();
        const filtered = currencies.filter((c) =>
            c.data.titles[this.lang].toLowerCase().includes(query.toLowerCase())
        );

        await this.view.updateCurrencyList(filtered, isSend);
        await this.view.updateTabList(currencies, true);
        await this.view.updateTabList(currencies, false);
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

            const newSend = { ...pair.get };
            const newGet = { ...pair.send };

            await this.applyNewPair(newSend, newGet);
        });
    }
    async onSubmit(e: JQuery.SubmitEvent<HTMLElement>) {
      const send = this.state.getSelectedSend();
      const get = this.state.getSelectedGet();
    
      if (!send || !get || !send.amount || !get.amount) {
        this.view.showError("Пожалуйста, заполните все необходимые поля.");
        return false;
      }
    
      this.emit("onSubmit", e, send, get);
      return true;
    }
    
}
