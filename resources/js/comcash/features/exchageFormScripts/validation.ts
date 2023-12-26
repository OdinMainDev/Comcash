import $ from 'jquery';
import { getEstimate } from '@/shared/api/getEstimate';
import { ICurrency } from '@/shared/models/interfaces/currency';
import { settingsLayouts } from './constants';
import { settingsLayoutTypes } from '@/shared/models/types/settings';

export const initializeValidationModal = (selectedCurrencyYouSend: ICurrency, selectedCurrencyYouGet: ICurrency, currencyYouSendAmount: number, currencyYouGetAmount: number, layout: settingsLayoutTypes[]) => {
  const exchangeForm = $('.exchange__form');
  const validation = $(document).find('.validation');
  const validationYouGet = validation.find('#validation__you-get');
  const validationYouSend = validation.find('#validation__you-send');
  const validationBackButton = validation.find('#validation__back');
  const validationSendButton = validation.find('#validation__send');
  const validationCaptioSend = validation.find('.validation__caption_send');
  const validationCaptionGet = validation.find('.validation__caption_get');
  const url = window.location.href;
  const languagePattern = /\/(en|ru)\/?/;

  const match = url.match(languagePattern);
  if (match && (match[1] === 'en' || match[1] === 'ru')) {
    const languageAbbreviation: 'en' | 'ru' = match[1];
    validationYouSend.html(`<span>${currencyYouSendAmount}</span>&ensp;<span>${selectedCurrencyYouSend.data.titles[languageAbbreviation]}</span>`);
    validationYouGet.html(`<span>${currencyYouGetAmount}</span>&ensp;<span>${selectedCurrencyYouGet.data.titles[languageAbbreviation]}</span>`);
  } else {
    validationYouSend.html(`<span>${currencyYouSendAmount}</span>&ensp;<span>${selectedCurrencyYouSend.data.titles.en}</span>`);
    validationYouGet.html(`<span>${currencyYouGetAmount}</span>&ensp;<span>${selectedCurrencyYouGet.data.titles.en}</span>`);
  }


  validationBackButton.on('click', function(event: { preventDefault: () => void; }) {
    event.preventDefault();
    exchangeForm.find('.exchange__main-form').removeClass('hide');
    exchangeForm.find('.validation').addClass('hide')
  });

  validationSendButton.on('click', function() {
    const filtredArray = settingsLayouts.filter(item => {
      return !layout.includes(item);
    });
    filtredArray.forEach(item => {
      exchangeForm.find(`#exchange-${item} > input`).removeAttr('name');
    })
  })


  async function getValidationCaptioSend () {
    const data = await getEstimate(selectedCurrencyYouSend.name, selectedCurrencyYouGet.name, 1);
    validationCaptioSend.html(`1 ${selectedCurrencyYouSend.name}&ensp;≈&ensp;${data.amount} ${selectedCurrencyYouGet.name}`)
  }

  async function getValidationCaptioGet () {
    const data = await getEstimate(selectedCurrencyYouGet.name, selectedCurrencyYouSend.name, 1);
    validationCaptionGet.html(`1 ${selectedCurrencyYouGet.name}&ensp;≈&ensp;${data.amount} ${selectedCurrencyYouSend.name}`)
  }

  async function showExchangeRate() {
    getValidationCaptioGet()
    getValidationCaptioSend()
  }

  showExchangeRate();
}
