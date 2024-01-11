import axios from 'axios';

interface IConfirm {
  lang: string;
  id: number
}

interface IData {
  success: boolean,
  data: boolean,
}


export const getConfirmStatus = async (data: IConfirm): Promise<IData> => {
  try {
    const {lang, id} = data;
    const res = await axios.get(`${import.meta.env.VITE_API_URL}/${lang}/exchange/kyc/status/${id}`)
    return res.data
  } catch(e) {
    return {
      success: false,
      data: false,
    }
  }
}