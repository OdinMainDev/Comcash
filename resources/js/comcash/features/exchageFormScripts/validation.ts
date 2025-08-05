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
  const validationYouGetCurrency = validation.find('#validation__you-get-currency');
  const validationYouSendCurrency = validationYouSend.find('#validation__you-send-currency');
  const validationYouGetCurrencyImg = validation.find('#validation__you-get-currency-img');
  const validationYouSendCurrencyImg = validationYouSend.find('#validation__you-send-currency-img');
  const validationYouGetAmount = validation.find('#validation__you-get-amount');
  const validationYouSendAmount = validationYouSend.find('#validation__you-send-amount');
  const validationBackButton = validation.find('#validation__back');
  const validationSendButton = validation.find('#validation__send');
  const validationCaptioSend = validation.find('.validation__caption_send');
  const validationCaptionGet = validation.find('.validation__caption_get');
  const url = window.location.href;
  const languagePattern = /\/(en|ru)\/?/;

  const match = url.match(languagePattern);

  validationYouSendAmount.text(currencyYouSendAmount);
  validationYouGetAmount.text(currencyYouGetAmount);


  validationYouSendCurrencyImg.attr('src', selectedCurrencyYouSend.image);
  validationYouGetCurrencyImg.attr('src', selectedCurrencyYouGet.image);

  if (match && (match[1] === 'en' || match[1] === 'ru')) {
    const languageAbbreviation: 'en' | 'ru' = match[1];

    validationYouSendCurrency.text(selectedCurrencyYouSend.data.titles[languageAbbreviation]);
    validationYouGetCurrency.text(selectedCurrencyYouGet.data.titles[languageAbbreviation]);

  } else {
    validationYouSendCurrency.text(selectedCurrencyYouSend.data.titles.en);
    validationYouGetCurrency.text(selectedCurrencyYouGet.data.titles.en);

  }


  validationBackButton.on('click', function(event: { preventDefault: () => void; }) {
    event.preventDefault();
    exchangeForm.find('.exchange__main-form').removeClass('hide');
    exchangeForm.find('.validation').addClass('hide')
  });

  exchangeForm.on('submit', function (e) {
      e.preventDefault();

      const filtredArray = settingsLayouts.filter(item => {
          return !layout.includes(item);
      });

      filtredArray.forEach(item => {
          exchangeForm.find(`#exchange-${item} > input`).removeAttr('name');
      });

        (this as HTMLFormElement).submit();


  });


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
