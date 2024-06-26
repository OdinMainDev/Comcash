import axios from "axios";
import { ICurrency, IDirection } from "../models/interfaces";
import { getCurrenciesApi } from "@/shared/api/getCurrenciesApi";

export const getDirectionsApi = ():string => {
  return `${import.meta.env.VITE_API_URL}/api/get/directions`;
}

export const getCurrenciesFromApi = ():string => {
  return `${import.meta.env.VITE_API_URL}/api/get/directions/currencies/from`;
}

export async function getDirections(): Promise<IDirection[]> {
  try {
    const { data } = await axios.get<{data: IDirection[]}>(getDirectionsApi())
    return data.data;
  } catch(e) {
    console.log(e)
    return [];
  }
}

export const getRatessApi = ():string => {
  return `${import.meta.env.VITE_API_URL}/api/get/rates`;
}

export async function getCurrencies(): Promise<ICurrency[]> {
  try {
    const { data } = await axios.get<ICurrency[]>(getCurrenciesApi(window.language ? window.language : "ru"))
    return data;
  } catch(e) {
    console.log(e)
    return [];
  }
}

export async function getCurrenciesFrom(): Promise<ICurrency[]> {
  try {
    const { data } = await axios.get<{data: ICurrency[]}>(getCurrenciesFromApi())
    return data.data;
  } catch(e) {
    console.log(e)
    return [];
  }
}
