import axios from 'axios'
import { ISetting } from '@/shared/models/interfaces/settings';

export const getCurrencySettings = async (currency_from: string, currency_to: string):Promise<ISetting> => {
  try {
    const res = await axios.get(`${import.meta.env.VITE_API_URL}/api/get/direction/settings`, {
      params: {
        currency_from,
        currency_to
      }
    })
    if (!res.data.success) {
      throw 'error'
    }
    const data: ISetting = {
      ...res.data.data,
      layout: Object.values(res.data.data.layout)
    }
    return data;
  } catch (e) {
    throw e;
  }

}