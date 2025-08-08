import { ICurrency } from "@/shared/models/interfaces/currency";
import { ParsedURLDefaults, SelectedCurrency } from "./types";

export function parseDefaultSelectionFromURL(): ParsedURLDefaults {
    const currentPageURL = window.location.href;
    const url = new URL(currentPageURL);

    const amount = url.searchParams.get("amount");
    const amountNum = amount ? parseFloat(amount) : undefined;

    const parts = url.pathname.split("/");
    const currencyPart = parts.find((part) => part.includes("-"));

    let currencyFrom = undefined;
    let currencyTo = undefined;

    if (currencyPart) {
        const [from, to] = currencyPart.split("-");
        if (from && to) {
            currencyFrom = from.toUpperCase();
            currencyTo = to.toUpperCase();
        }
    }

    return {
        currencyFrom,
        currencyTo,
        amount: amountNum,
    };
}

export type DefaultPair = {
    send: string;
    get: string;
}

export function getDefaultCurrencies(
    currencies: ICurrency[],
    defaults: ParsedURLDefaults,
    defaultPair?: DefaultPair
  ): { send: SelectedCurrency; get: SelectedCurrency } {
    let send = currencies.find(c => c.name === defaults.currencyFrom);
    let get = currencies.find(c => c.name === defaults.currencyTo);
  
    if (!send && defaultPair?.send) {
        send = currencies.find(c => c.name === defaultPair.send);
    }
  
    if (!get && defaultPair?.get) {
        get = currencies.find(c => c.name === defaultPair.get);
    }
  
    if (!send) {
      send = currencies[0];
    }
  
    if (!get || get.name === send.name) {
      get = currencies.find(c => c.name !== send.name) || currencies[1];
    }
  
    return {
      send: {
        currency: send,
        amount: defaults.amount == null ? null : defaults.amount,
      },
      get: {
        currency: get,
        amount: null,
      },
    };
  }

export function getCurrentLanguage(): string {

  return window.language || 'en';
//   const match = window.location.href.match(/\/(en|ru)\//);
//   return match && (match[1] === 'en' || match[1] === 'ru') ? match[1] as 'en' | 'ru' : 'en';
}

export async function safeCall<T>(
  fn: () => Promise<T>,
  errorMessage: string,
  onError?: (error: unknown) => void,
  retries = 0
): Promise<T | null> {
  for (let attempt = 0; attempt <= retries; attempt++) {
    try {
      return await fn();
    } catch (error) {
      if (attempt === retries) {
        console.error(errorMessage, error);
        if (onError) onError(error);
        return null;
      }
    }
  }
  return null;
}
