import $ from 'jquery';

export function removeSpaces(this: HTMLInputElement) {
  const inputValue = $(this).val()?.toString()?.trim();
  if (inputValue !== undefined) {
    $(this).val(inputValue);
  }
}