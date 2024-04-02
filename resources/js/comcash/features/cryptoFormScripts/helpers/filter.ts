import { ICurrency, IRate } from "../models/interfaces"

export const filterByTag = (currencies: ICurrency[], tag: "fiat" | "crypto") => {
  return currencies.filter(item => item.tag === tag)
}

export const findRateByCurrency = (currencyFromName: string, currencyToName: string, rates: IRate[]): number  => {
  console.log(currencyFromName, currencyToName)
  const rate = rates.find(item => (item.from === currencyFromName) && (item.to === currencyToName));
  return rate?.rate ? Number(rate?.rate) : 0;
}
