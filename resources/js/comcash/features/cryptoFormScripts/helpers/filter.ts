import { ICurrency, IRate } from "../models/interfaces"

export const filterByTag = (currencies: ICurrency[], tag: "fiat" | "crypto" | "cash") => {
  return currencies.filter(item => item.tag === tag)
}

export const findRateByCurrency = (currencyFromName: string, currencyToName: string, rates: IRate[]): number  => {
  let toName = currencyToName;
  if(["SBERRUB", "TCSBRUB", "CASHRUB", "CARDRUB", "SBPRUB"].find(item => item === toName)) {
    toName = "RUB"
  } else if(["USDTTRC20", "USDTERC20"].find(item => item === toName)) {
    toName = "USDT"
  } else if(["TONCOIN"].find(item => item === toName)) {
    toName = "TON"
  } else if(["CARDUSD", "CASHUSD"].find(item => item === toName)) {
    toName = "USD"
  } else if(["CASHEUR"].find(item => item === toName)) {
    toName = "EUR"
  } else if(["BNBBEP20"].find(item => item === toName)) {
    toName = "BNB"
  }
  

  const rate = rates.find(item => (item.from === currencyFromName) && (item.to === toName));
  return rate?.rate ? Number(rate?.rate) : 0;
}
