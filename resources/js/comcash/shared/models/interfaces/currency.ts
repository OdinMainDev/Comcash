import { ITitles } from "@/features/cryptoFormScripts/models/interfaces";

export interface ICurrency {
  data: {
    titles: ITitles
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