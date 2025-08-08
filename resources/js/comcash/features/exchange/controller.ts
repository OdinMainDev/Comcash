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

enum Side {
  Send = "send",
  Get = "get",
}

export class ExchangeController {
  private view: ExchangeView;
  private state = new ExchangeState();
  private defaultPair?: DefaultPair;
  private refresher: RateRefresher;
  private lang = getCurrentLanguage();

  constructor(view: ExchangeView, defaultPair?: DefaultPair) {
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
      onInputChange: (val, isSend) => this.onInputChange(val, isSend),
      onInputSearchChange: (query, isSend) =>
        this.onInputSearchChange(query, isSend),
      onCurrencySelect: (currency, isSend) =>
        this.onCurrencySelect(currency, isSend),
      onTabSelect: (tab, isSend) => this.onTabSelect(tab, isSend),
      onReverse: () => this.onReverse(),
    });
  }

  private restartRefresher(send: SelectedCurrency, get: SelectedCurrency) {
    this.refresher.stop();
    this.refresher.start(send, get);
  }

  private getCurrentPair(): { send: SelectedCurrency; get: SelectedCurrency } | null {
    const send = this.state.getSelectedSend();
    const get = this.state.getSelectedGet();
    if (!send || !get) return null;
    return { send, get };
  }

  private async applyNewPair(send: SelectedCurrency, get: SelectedCurrency) {
    this.state.selectSendCurrency(send);
    this.state.selectGetCurrency(get);
    await this.updatePair(send, get);
    await this.renderGlobalCourse();
    this.restartRefresher(send, get);
  }

  private async renderGlobalCourse() {
    const pair = this.getCurrentPair();
    if (!pair) return;

    const estimate = await safeCall(
      () => ExchangeApiService.getEstimate(pair.send.currency.name, pair.get.currency.name, 1),
      "Ошибка при получении глобального курса"
    );

    if (estimate) {
      this.view.updateGlobalCourse(
        `1 ${pair.send.currency.name}`,
        `${estimate.amount} ${pair.get.currency.name}`
      );
    }
  }

  private async updatePair(
    send: SelectedCurrency,
    get: SelectedCurrency,
    side: Side = Side.Send,
    renderOnlyTarget = false
  ) {
    const { from, to } = await this.updateAmounts(send, get, side);

    this.state.selectSendCurrency(from);
    this.state.selectGetCurrency(to);

    if (renderOnlyTarget) {
      const isSend = side === Side.Send;
      this.view.setSelected(isSend ? to : from, !isSend);
    } else {
      this.renderSelected();
    }
  }

  private async updateAmounts(
    send: SelectedCurrency,
    get: SelectedCurrency,
    leadingSide?: Side
  ) {
    const activeSide = leadingSide ?? this.getLeadingSide(send, get);
    const from = activeSide === Side.Send ? send : get;
    const to = activeSide === Side.Send ? get : send;

    if (!from.amount) {
      await this.updateMinAmount(from, to);
    }

    const estimate = await safeCall(
      () => ExchangeApiService.getEstimate(from.currency.name, to.currency.name, from.amount!),
      "Ошибка при получении курса обмена",
      () => this.view.showError("Не удалось получить курс обмена")
    );

    if (estimate) {
      to.amount = estimate.amount;
    } else {
      from.amount = 0;
      to.amount = 0;
    }

    return { from, to };
  }

  private async updateMinAmount(from: SelectedCurrency, to: SelectedCurrency) {
    const settings = await safeCall(
      () => ExchangeApiService.getCurrencySettings(from.currency.name, to.currency.name),
      "Ошибка при получении минимальной суммы"
    );

    if (settings) {
      from.amount = settings.data.min_amount;
    }
  }

  private getLeadingSide(send: SelectedCurrency, get: SelectedCurrency): Side {
    if (send.amount != null && get.amount == null) return Side.Send;
    if (get.amount != null && send.amount == null) return Side.Get;
    return Side.Send;
  }

  private async renderUSDTHint() {
    const send = this.state.getSelectedSend();
    if (send && send.amount) {
      const result = await safeCall(
        () => ExchangeApiService.getUSDTERC(send.currency.name, send.amount),
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
      if (currency) this.view.setSelected(currency, isSend);
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
  
    const filtered = normalizedTab && normalizedTab !== "all"
      ? currencies.filter(c => c.tag.toLowerCase() === normalizedTab)
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
    const pair = this.getCurrentPair();
    if (!pair) return;

    if (isSend) {
      pair.send.amount = val;
      await this.updatePair(pair.send, pair.get, Side.Send, true);
    } else {
      pair.get.amount = val;
      await this.updatePair(pair.send, pair.get, Side.Get, true);
    }

    this.restartRefresher(pair.send, pair.get);
    await this.renderUSDTHint();
  }

  async onCurrencySelect(currency: ICurrency, isSend: boolean) {
    const pair = this.getCurrentPair();
    if (!pair) return;

    const selected = { currency, amount: null };
    const newSend = isSend ? selected : pair.send;
    const newGet = isSend ? pair.get : selected;

    await this.applyNewPair(newSend, newGet);
  }

  async onReverse() {
    const pair = this.getCurrentPair();
    if (!pair) return;

    const newSend = { ...pair.get };
    const newGet = { ...pair.send };

    await this.applyNewPair(newSend, newGet);
  }
}
