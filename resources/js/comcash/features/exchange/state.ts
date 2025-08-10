import { ISetting } from "@/shared/models/interfaces/settings";
import { SelectedCurrency } from "./types";
import { ICurrency } from "@/shared/models/interfaces/currency";

export class ExchangeState {
    private selectedSend: SelectedCurrency | null = null;
    private selectedGet: SelectedCurrency | null = null;
    private currencies: ICurrency[] = [];
    private sendCurrencies: ICurrency[] = [];
    private settings: ISetting | null = null;
    private locked: boolean = false;
    

    selectSendCurrency(currency: SelectedCurrency) {
        this.selectedSend = { ...currency };
    }

    selectGetCurrency(currency: SelectedCurrency) {
        this.selectedGet = { ...currency };
    }

    getSelectedSend(): SelectedCurrency | null {
        return this.selectedSend;
    }

    getSelectedGet(): SelectedCurrency | null {
        return this.selectedGet;
    }
    setSendCurrencies(currencies: ICurrency[]) {
        this.sendCurrencies = currencies;
    }
    setCurrencies(currencies: ICurrency[]) {
        this.currencies = currencies;
    }
    setSettings(settings: ISetting) {
        this.settings = settings
    }
    getSendCurrencies() {
        return this.sendCurrencies;
    }
    getCurrencies() {
        return this.currencies;
    }
    getSettings() {
        return this.settings;
    }
    isCurrentSettings(from: SelectedCurrency, to: SelectedCurrency) {
        return this.settings?.currency_from.name == from.currency.name
        && this.settings?.currency_to.name == to.currency.name
    }
    setLocked(locked: boolean) {
        this.locked = locked;
    }
    isLocked() {
        return this.locked;
    }
}
