import { ICurrency } from "../cryptoFormScripts/models/interfaces";
import { SelectedCurrency } from "./types";

export class ExchangeState {
    private selectedSend: SelectedCurrency | null = null;
    private selectedGet: SelectedCurrency | null = null;
    private currencies: ICurrency[] = [];

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

    setCurrencies(currencies: ICurrency[]) {
        this.currencies = currencies;
    }

    getCurrencies() {
        return this.currencies;
    }
}
