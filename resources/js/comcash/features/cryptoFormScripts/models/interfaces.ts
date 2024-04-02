export interface IDirection {
  currency_from: ICurrency
  currency_to: ICurrency
  data: IDirectionData
  layout: string[]
}


export interface IData {
  titles: ITitles
}

export interface ITitles {
  ru: string
  en: string
}

export interface ICurrency{
  id: number
  name: string
  units: number
  image: string
  data: ICurrencyData
  tag: "fiat" | "crypto";
}

export interface ICurrencyData {
  titles: ITitles
}

export interface IDirectionData {
  min_amount: string
  max_amount: string
}


export interface IRate {
  id: number;
  from: string;
  to: string;
  rate: string;
}