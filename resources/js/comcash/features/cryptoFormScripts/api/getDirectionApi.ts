import axios from "axios";
import { ICurrency } from "../models/interfaces";
import { getCurrenciesApi } from "@/shared/api/getCurrenciesApi";

export const getDirectionsApi = ():string => {
  return `${import.meta.env.VITE_API_URL}/api/get/directions`;
}

export const getRatessApi = ():string => {
  return `${import.meta.env.VITE_API_URL}/api/get/rates`;
}

export async function getCurrencies(): Promise<ICurrency[]> {
  try {
    const { data } = await axios.get<ICurrency[]>(getCurrenciesApi())
    return data;
  } catch(e) {
    console.log(e)
    return [];
  }
}