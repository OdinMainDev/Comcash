export interface ICurrency {
  data: {
    titles: {
      ru: string;
      en: string;
    }
  }
  id: number;
  image: string;
  name: string;
  units: number;
  tag: string;
}

export interface IEstimate {
  amount: number;
  min_amount: number;
  exchange_rate: number;
}