import $ from 'jquery';
import axios from 'axios';

import { defaultCurrencyYouGet, defaultCurrencyYouSend, settingsLayouts } from './constants';

import { getEstimate } from '@/shared/api/getEstimate';
import { getCurrencySettings } from './api/getCurrencySettings';
import { getCurrenciesApi } from '@/shared/api/getCurrenciesApi';

import { ICurrency } from '@/shared/models/interfaces/currency';
import { settingsLayoutTypes } from '@/shared/models/types/settings';


import { removeSpaces } from './helpers/removeSpaces';
import { formatCardNumber } from './helpers/formatCardNumber';
import { isValidEmail } from './helpers/validators';
import { initializeValidationModal } from './validation';
import { getHTMLListItem, selectItem } from '@/shared/scripts/select';
import { errorValidator } from './helpers/errorValidator';


$(document).ready(function () {
  const select = $('.custom-select__select-container');
  const exchangeForm = $('.exchange__form');
  const currencyYouSend= $('#currencyYouSend')
  const currencyYouGet = $('#currencyYouGet');
  const labelCurrencyYouSend = currencyYouSend.find('.custom-select__select-label');
  const labelCurrencyYouGet = currencyYouGet.find('.custom-select__select-label');
  // const currencyYouGetMin = currencyYouGet.find('.exchange__min > span');
  const currencyYouSendMin = currencyYouSend.find('.exchange__min > span');
  const currencyYouSendMax = currencyYouSend.find('.exchange__max > span');

  // const currencyYouGetMin = currencyYouGet.find('.exchange__min > span');
  // const currencyYouGetMax = currencyYouGet.find('.exchange__max > span');

  const openModalButton = exchangeForm.find('.exchange__button')
  const timer = currencyYouGet.find('.exchange__timer');

  const inputCurrencyYouSend = exchangeForm.find('#exchange-currency_from > .input');
  const inputCurrencyYouGet = exchangeForm.find('#exchange-currency_to > .input');
  const inputFromCardNumber = exchangeForm.find('#exchange-from_card > .input');
  const inputToCardNumber = exchangeForm.find('#exchange-to_card > .input');
  const inputFirstName = exchangeForm.find('#exchange-first_name > input');
  const inputLastName = exchangeForm.find('#exchange-last_name > input');
  const inputSecondName = exchangeForm.find('#exchange-second_name > input');
  const inputPhoneNumber = exchangeForm.find('#exchange-phone > input');
  const inputEmail = exchangeForm.find('#exchange-email > input');
  const inputTelegram = exchangeForm.find('#exchange-telegram > input');
  const inputToAddress = exchangeForm.find('#exchange-to_address > input');
  const inputFromAddress = exchangeForm.find('#exchange-from_address > input');
  const inputPassport = exchangeForm.find('#exchange-passport > input');
  const currencyLock = exchangeForm.find('.exchange__currency-lock');

  let selectedCurrencyYouSend: ICurrency = defaultCurrencyYouSend;
  let selectedCurrencyYouGet: ICurrency = defaultCurrencyYouGet;
  let currencyYouSendMaxAmount = 0;
  let currencyYouSendMinAmount = 0;
  let currencyYouSendAmount = 0;
  let currencyYouGetAmount = 0;
  let isLock = false;

  let impossimbleExchange = false;
  const timerInSeconds = 5;
  let countdown = timerInSeconds;
  let settingsLayout: settingsLayoutTypes[] = [];
  let currencyTimeout: ReturnType<typeof setTimeout> | null = null;


  inputCurrencyYouSend.on('input', onChangeYouSendInput);
  inputCurrencyYouGet.on('input', onChangeYouGetInput);
  inputFromCardNumber.on('input', onChangeCardNumberInput);
  inputToCardNumber.on('input', onChangeCardNumberInput);
  inputFirstName.on('input', removeSpaces);
  inputLastName.on('input', removeSpaces);
  inputSecondName.on('input', removeSpaces);
  inputTelegram.on('input', removeSpaces);
  inputEmail.on('input', removeSpaces);
  inputPhoneNumber.on('input', onChangePhoneNumber)
  openModalButton.on('click', sendData);
  currencyLock.on('click', lockInput);


  function onChangeCardNumberInput(this: HTMLInputElement) {
    const cardNumber = $(this).val()?.toString() || '';
    $(this).val(formatCardNumber(cardNumber));
  }

  function lockInput(this: HTMLDivElement) {
    const open = currencyLock.find('.exchange__currency-lock_open');
    const close = currencyLock.find('.exchange__currency-lock_close');
    isLock = !isLock;
    open.toggle();
    close.toggle();
  }

  function onChangeYouGetInput(this: HTMLInputElement) {
    const value = $(this).val()?.toString().replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    $(this).val(value as string);
    const changedNumber = Number(value);
    if (currencyYouGetAmount !== changedNumber) {
      currencyYouGetAmount = changedNumber;
      changeYouGetValue();
    }
  }

  function onChangeYouSendInput(this: HTMLInputElement) {
    const value = $(this).val()?.toString().replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    $(this).val(value as string);
    const changedNumber = Number(value);
    const isGreaterThanMax = changedNumber > currencyYouSendMaxAmount;
    const isLessThanMin = changedNumber < currencyYouSendMinAmount;

    if (isGreaterThanMax || isLessThanMin) {
      inputCurrencyYouSend.parent().addClass('input--error');
      currencyYouSendMax.parent().toggleClass('exchange__limit-error', isGreaterThanMax);
      currencyYouSendMin.parent().toggleClass('exchange__limit-error', isLessThanMin);
      setTimeout(() => {
          inputCurrencyYouSend.parent().removeClass('input--error');
          currencyYouSendMax.parent().removeClass('exchange__limit-error');
          currencyYouSendMin.parent().removeClass('exchange__limit-error');
      }, 1000);
    }

    if (currencyYouSendAmount !== changedNumber) {
      currencyYouSendAmount = changedNumber;
      changeYouSendValue();
    }

  }

  function hideAllLayouts() {
    settingsLayouts.forEach(item => {
      const element = exchangeForm.find(`#exchange-${item}`)
      element.addClass('hide');
    })
  }

  function onChangePhoneNumber(this: HTMLInputElement) {
    const value = $(this).val()?.toString()?.trim().replace(/\+/g, '')
    $(this).val(`+${value}`);
  }

  function startTimerUploadNewCurrency() {
    timer.text(`00:${countdown.toString().padStart(2, '0')}`);
    if (countdown === 0) {
      if (isLock) {
        changeYouGetValue()
          .finally(() => {
            countdown = timerInSeconds;
            startTimerUploadNewCurrency();
          });
      } else {
        changeYouSendValue()
          .finally(() => {
            countdown = timerInSeconds;
            startTimerUploadNewCurrency();
          });
      }
    } else {
      currencyTimeout = setTimeout(startTimerUploadNewCurrency, 1000);
    }
    countdown--;
  }

  async function getDefaultData(list: ICurrency[]) {
    try {
      const currentPageURL = window.location.href;
      const urlParams = new URLSearchParams(currentPageURL);
      const amount = urlParams.get('amount');

      const parts = currentPageURL.split('/');
      const currencyPart = parts.find(part => part.includes('-'));
      let currencyFromUrl = '';
      let currencyToUrl = '';
      if (currencyPart) {
        const currencies = currencyPart.split('-');
        if (currencies.length === 2) {
          currencyFromUrl = currencies[0];
          currencyToUrl = currencies[1];
        }
      }
      list.forEach(item => {
        if(item.name  === currencyFromUrl) {
          selectedCurrencyYouSend = item;
        } else if(item.name  === currencyToUrl) {
          selectedCurrencyYouGet = item;
        }
      })
      currencyYouSendAmount = Number(amount);
      inputCurrencyYouSend.val(currencyYouSendAmount);
      selectItem(labelCurrencyYouSend, selectedCurrencyYouSend);
      selectItem(labelCurrencyYouGet, selectedCurrencyYouGet);
      const data = await getCurrencySettings(selectedCurrencyYouSend.name, selectedCurrencyYouGet.name);
      currencyYouSendMaxAmount = data.data.max_amount;
      currencyYouSendMinAmount = data.data.min_amount;
      if(!currencyYouSendAmount) {
        currencyYouSendAmount = Number(amount);
        inputCurrencyYouSend.val(currencyYouSendMinAmount);
      }
      currencyYouSendMin.text(currencyYouSendMinAmount);
      currencyYouSendMax.text(currencyYouSendMaxAmount);
      settingsLayout = data.layout;
      settingsLayout.forEach(item => {
        exchangeForm.find(`#exchange-${item}`).removeClass('hide')
      })
      changeYouSendValue()
    } catch (e) {
      console.log(e)
    }
  }

  async function getSettings(currencyFrom: string, currencyTo: string) {
    try {

      const data = await getCurrencySettings(currencyFrom, currencyTo);
      currencyYouSendMaxAmount = data.data.max_amount;
      currencyYouSendMinAmount = data.data.min_amount;
      currencyYouSendAmount = currencyYouSendMinAmount;
      currencyYouSendMin.text(currencyYouSendMinAmount);
      currencyYouSendMax.text(currencyYouSendMaxAmount);
      inputCurrencyYouSend.val(currencyYouSendAmount);
      selectItem(labelCurrencyYouSend, selectedCurrencyYouSend);
      selectItem(labelCurrencyYouGet, selectedCurrencyYouGet);
      settingsLayout = data.layout;
      settingsLayout.forEach(item => {
        exchangeForm.find(`#exchange-${item}`).removeClass('hide')
      })

    } catch (e) {
      errorHandler(e);
    }

  }

  async function changeYouGetValue(withSettings?: boolean) {
    loadingCurrencyYouSend(true);
    restartCurrencyTimer();
    if(withSettings) {
      await getSettings(selectedCurrencyYouSend.name, selectedCurrencyYouGet.name)
    }

    try {
      const data = await getEstimate(selectedCurrencyYouSend.name, selectedCurrencyYouGet.name, currencyYouGetAmount, 1);
      currencyYouSendAmount = data.amount;
      inputCurrencyYouSend.val(currencyYouSendAmount)

    } catch (e) {
      errorHandler(e);
    }

    loadingCurrencyYouSend(false);
  }

  async function changeYouSendValue(withSettings?: boolean) {
    loadingCurrencyYouGet(true);
    restartCurrencyTimer();
    if(withSettings) {
      await getSettings(selectedCurrencyYouSend.name, selectedCurrencyYouGet.name)
    }


    try {
      const data = await getEstimate(selectedCurrencyYouSend.name, selectedCurrencyYouGet.name, currencyYouSendAmount);
      currencyYouGetAmount = data.amount;
      inputCurrencyYouGet.val(currencyYouGetAmount)
    } catch(e) {
      errorHandler(e);
    }

    loadingCurrencyYouGet(false);
  }

  function errorHandler(error: unknown) {
    currencyYouSendAmount = 0;
    currencyYouGetAmount = 0;
    impossimbleExchange = true;
    inputCurrencyYouSend.val('Недоступный вариант обмена!');
    inputCurrencyYouGet.val('Недоступный вариант обмена!');
    stopCurrencyTimer();
    errorValidator(error)
  }

  function restartCurrencyTimer() {
    if(!currencyTimeout) {
      startTimerUploadNewCurrency()
    }
    countdown = timerInSeconds;
  }

  function stopCurrencyTimer() {
    if(currencyTimeout) {
      timer.text('00:00');
      clearTimeout(currencyTimeout);
      currencyTimeout = null;
    }
  }

  function loadingCurrencyYouSend(value: boolean) {
    if (value) {
      currencyYouSend.find('.custom-select__select-loader').addClass('loading');
      inputCurrencyYouSend.val('')
    } else {
      currencyYouSend.find('.custom-select__select-loader').removeClass('loading');
    }
  }

  function loadingCurrencyYouGet(value: boolean) {
    if (value) {
      currencyYouGet.find('.custom-select__select-loader').addClass('loading')
      inputCurrencyYouGet.val('')
    } else {
      currencyYouGet.find('.custom-select__select-loader').removeClass('loading')
    }
  }

  async function getCurrenciesList(): Promise<ICurrency[]> {
    try {
      loadingCurrencyYouSend(true)
      loadingCurrencyYouGet(true);
      const res = await axios.get(getCurrenciesApi())
      const currenciesList:ICurrency[] = res.data;
      currenciesList.forEach(currency => {
        const $listItem = $(getHTMLListItem(currency));

        $listItem.on('click', function() {
          selectListItem.call(this, currency);
        })
        $('.exchange__form').find('.custom-select__select-list').append($listItem);
      })
      loadingCurrencyYouSend(false)
      loadingCurrencyYouGet(false);
      return currenciesList;
    } catch(error) {
      console.error(error);
      loadingCurrencyYouSend(false)
      loadingCurrencyYouGet(false);
      return [];
    }
  }

  async function selectListItem (this: HTMLElement, currency: ICurrency) {
    const parentSelect = $(this).closest('.custom-select__select-container');
    const isCurrencyYouSend = parentSelect.data('currency') === 'currencyYouSend';
    select.find('.custom-select__select-list')?.toggleClass('hide');
    select.toggleClass('active');
    hideAllLayouts();
    impossimbleExchange = false;

    if(isCurrencyYouSend && currency.name !== selectedCurrencyYouSend.name) {
      if(currency.name === selectedCurrencyYouGet.name) {
        selectItem(labelCurrencyYouGet, selectedCurrencyYouSend)
        swapCurrencies()
      } else {
        selectedCurrencyYouSend = currency;
      }
    } else if(!isCurrencyYouSend && currency.name !== selectedCurrencyYouGet.name) {
      if(currency.name === selectedCurrencyYouSend.name) {
        selectItem(labelCurrencyYouSend, selectedCurrencyYouGet)
        swapCurrencies()
      } else {
        selectedCurrencyYouGet = currency;
      }

    }
    await changeYouSendValue(true);
    selectItem(parentSelect.find('.custom-select__select-label'), currency)
  }

  function swapCurrencies() {
    const tmp = selectedCurrencyYouGet;
    selectedCurrencyYouGet = selectedCurrencyYouSend;
    selectedCurrencyYouSend = tmp;
  }

  function sendData (event: { preventDefault: () => void; }) {
    event.preventDefault();
    let isError = false;
    const data = {
      first_name: inputFirstName.val(),
      last_name: inputLastName.val(),
      second_name: inputSecondName.val(),
      email: inputEmail.val(),
      phone: inputPhoneNumber.val()?.toString().replace(/\+/g, ''),
      telegram: inputTelegram.val(),
      from_card: inputFromCardNumber.val()?.toString().replace(/\s+/g, ''),
      to_card: inputToCardNumber.val()?.toString().replace(/\s+/g, ''),
      currency_from: selectedCurrencyYouSend.name,
      currency_to: selectedCurrencyYouGet.name,
      amount: currencyYouSendAmount,
      to_address: inputToAddress.val(),
      from_address: inputFromAddress.val(),
      passport: inputPassport.val()
    }

    settingsLayout.forEach(item => {
      const $input = exchangeForm.find(`#exchange-${item} > input`);
      // eslint-disable-next-line @typescript-eslint/no-explicit-any
      const itemValue: any = data[item];
      if (
        (item === 'email' && !isValidEmail(itemValue)) ||
        ((item === 'from_card' || item === 'to_card') && (!itemValue || itemValue.length !== 16)) ||
        (!itemValue || itemValue.toString().length === 0)
      ) {
        isError = true;
        $input.addClass('input--error');
        setTimeout(() => {
          $input.removeClass('input--error');
        }, 2000);
      }
    })
    const currencyArray = ['currency_to', 'currency_from'];
    currencyArray.forEach(item => {
      if((
        impossimbleExchange) ||
        (currencyYouSendAmount > currencyYouSendMaxAmount && currencyYouSendAmount < currencyYouSendMinAmount)
        ) {
          isError = true;
          const select = exchangeForm.find(`#exchange-${item}`);
          select.addClass('input--error');
          setTimeout(() => {
            select.removeClass('input--error');
          }, 2000);
        }
    })



    if(!isError) {
      exchangeForm.find('.exchange__main-form').addClass('hide');
      exchangeForm.find('.validation').removeClass('hide')
      initializeValidationModal(selectedCurrencyYouSend, selectedCurrencyYouGet, currencyYouSendAmount, currencyYouGetAmount, settingsLayout)
    }
  }
  const startApp = async () => {
    hideAllLayouts();
    startTimerUploadNewCurrency();
    const list = await getCurrenciesList();
    getDefaultData(list)
  }

  if (new URL(window.location.href).pathname.includes('exchange')) {
    startApp();
  }


})
