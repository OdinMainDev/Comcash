import axios from 'axios';
import { IEstimate } from '../models/interfaces/currency';

export const getConvetredToUSD = async (currency: string, amount: number): Promise<number> => {
  try {
    const res = await axios.get(`${import.meta.env.VITE_API_URL}/api/estimate`, {
      params: {
        currency_from: currency,
        currency_to: 'USDTTRC20',
        amount
      }
    });
    const data: IEstimate = res.data.data
    return Number(data.amount);
  } catch(e) {
    throw e;
  }
}