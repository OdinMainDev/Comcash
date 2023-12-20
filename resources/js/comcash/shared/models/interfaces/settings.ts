
import { settingsLayoutTypes } from '../types/settings';
import { ICurrency } from './currency';

export interface ISetting {
  currency_from: ICurrency,
  currency_to: ICurrency,
  data: ISettingData,
  layout: settingsLayoutTypes[];
}

export interface ISettingData {
  max_amount: number;
  min_amount: number;
}