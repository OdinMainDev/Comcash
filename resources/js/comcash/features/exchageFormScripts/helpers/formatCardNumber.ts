export const formatCardNumber = (value: string): string => {
  if (!value) {
    return '';
  }
  value = value.replace(/\D/g, '');
  value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
  return value.slice(0, 19);
}