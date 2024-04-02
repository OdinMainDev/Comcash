export const getDirectionsApi = ():string => {
  return `${import.meta.env.VITE_API_URL}/api/get/directions`;
}

export const getRatessApi = ():string => {
  return `${import.meta.env.VITE_API_URL}/api/get/rates`;
}