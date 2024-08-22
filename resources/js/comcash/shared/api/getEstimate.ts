import axios from 'axios'
import { IEstimate } from '../models/interfaces/currency';


export const getEstimate = async (
    currencyFrom: string,
    currencyTo: string,
    amount: number,
    reverse?: number,
    signal?: AbortSignal
  ): Promise<IEstimate> => {
    try {
      const res = await axios.get(`${import.meta.env.VITE_API_URL}/api/estimate`, {
        params: {
          currency_from: currencyFrom,
          currency_to: currencyTo,
          amount,
          reverse
        },
        signal,
      });

      const data: IEstimate = res.data.data;
      return data;
    } catch (e: any) {
      throw e;
    }
  };
