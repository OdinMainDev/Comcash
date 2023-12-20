export const getCurrenciesApi = (): string => {
  return `${import.meta.env.VITE_API_URL}/api/get/currencies`
}