import { getCurrenciesApi } from "@/shared/api/getCurrenciesApi";
import { getEstimate } from "@/shared/api/getEstimate";
import { ICurrency } from "@/shared/models/interfaces/currency";
import { ISetting } from "@/shared/models/interfaces/settings";
import axios from "axios";

const HINT_CURRENCY = "USDTERC20";

export class ExchangeApiService {
    private static currencySettingsController: AbortController | null = null;
    private static estimateController: AbortController | null = null;
    private static usdtEstimateController: AbortController | null = null;

    static async getCurrencies(): Promise<ICurrency[]> {
        const res = await axios.get(getCurrenciesApi());
        return res.data;
    }

    static async getCurrencySettings(currencyFrom: string, currencyTo: string) {
        if (this.currencySettingsController) {
            this.currencySettingsController.abort();
        }
        this.currencySettingsController = new AbortController();

        try {
            const res = await axios.get(
                `${import.meta.env.VITE_API_URL}/api/get/direction/settings`,
                {
                    params: {
                        currency_from: currencyFrom,
                        currency_to: currencyTo,
                    },
                    signal: this.currencySettingsController.signal,
                }
            );

            if (!res.data.success) {
                throw "error";
            }

            const data: ISetting = {
                ...res.data.data,
                layout: Object.values(res.data.data.layout),
            };

            return data;
        } catch (e) {
            if (axios.isCancel(e)) {
                console.warn("Currency settings request cancelled");
            }
            throw e;
        }
    }

    static async getEstimate(
        currencyFrom: string,
        currencyTo: string,
        amount: number,
        reverse = 0
    ) {
        if (this.estimateController) {
            this.estimateController.abort();
        }
        this.estimateController = new AbortController();

        return await getEstimate(currencyFrom, currencyTo, amount, reverse, this.estimateController.signal);
    }

    static async getUSDTERC(target: string, quantity: number) {
        if (this.usdtEstimateController) {
            this.usdtEstimateController.abort();
        }
        this.usdtEstimateController = new AbortController();

        return await getEstimate(target, HINT_CURRENCY, quantity, 0, this.usdtEstimateController.signal);
    }
}
