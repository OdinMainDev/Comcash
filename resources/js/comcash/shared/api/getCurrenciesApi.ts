export const getCurrenciesApi = (lang :string): string => {
  return `${import.meta.env.VITE_API_URL}/api/get/currencies?language=${lang}`
}