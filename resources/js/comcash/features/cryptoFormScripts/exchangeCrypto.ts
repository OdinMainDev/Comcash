import { defaultCryptoYouGet, defaultCryptoYouSend } from './constants';
import { ICurrency } from '../../shared/models/interfaces/currency';
import { getCurrenciesApi } from '../../shared/api/getCurrenciesApi';
import { getEstimate } from '../../shared/api/getEstimate';
import axios from 'axios';
import $ from 'jquery';
import { getHTMLListItem, selectItem } from '@/shared/scripts/select';
import { getCurrencySettings } from '../exchageFormScripts/api/getCurrencySettings';
import { ISettingData } from '@/shared/models/interfaces/settings';
import { errorValidator } from './helpers/errorValidator';
import { getConvetredToUSD } from '@/shared/api/getConvetredToUSD';

$(document).ready(function () {
  const cryptoYouGetSelect = $('#cryptoYouGetSelect');
  const cryptoYouSendSelect = $('#cryptoYouSendSelect');
  const select = $('.custom-select__select-container');
  const exchageForm = $('.crypto-form__exchange-form');
  const labelCurrencyYouSend = cryptoYouSendSelect.find('.custom-select__select-label');
  const labelCurrencyYouGet = cryptoYouGetSelect.find('.custom-select__select-label');
  const currencyYouSendMin = exchageForm.find('.welcome__send-min > span');
  const currencyYouSendMax = exchageForm.find('.welcome__send-max > span');
  const currencyYouGetMin = exchageForm.find('.welcome__get-min > span');
  const currencyYouGetMax = exchageForm.find('.welcome__get-max > span');

  const currencyConvertSend = exchageForm.find('.welcome__exchange-covert-send-currency');
  const usdConverSend = exchageForm.find('.welcome__exchange-covert-send-usd');

  const currencyConvertGet = exchageForm.find('.welcome__exchange-covert-get-currency');
  const usdConverGet = exchageForm.find('.welcome__exchange-covert-get-usd');

  const cryptoYouGet = $('#cryptoYouGet');
  const cryptoYouSend = $('#cryptoYouSend');

  let cryptoYouGetCurrency: ICurrency = defaultCryptoYouGet;
  let cryptoYouSendCurrency: ICurrency = defaultCryptoYouSend;

  let cryptoYouGetAmount = 0;
  let cryptoYouSendAmount = 0;



  cryptoYouSend.on('input', handleCryptoYouSendInput);
  cryptoYouGet.on('input', handleCryptoYouGetInput);
  $('.crypto-form__reverse').on('click', reverseCurrency);

  function loadingYouGetCurrency(value: boolean) {
    if (value) {
      cryptoYouGet.next().addClass('loading')
      cryptoYouGet.val('')
    } else {
      cryptoYouGet.next().removeClass('loading')
    }
  }

  function loadingYouSendCurrency(value: boolean) {
    if (value) {
      cryptoYouSend.next().addClass('loading');
      cryptoYouSend.val('')
    } else {
      cryptoYouSend.next().removeClass('loading');
    }
  }

  async function convertToGetValue(currency: string, amount: number) {
    currencyConvertGet.text(`${amount} ${currency}`)
    const value = await getConvetredToUSD(currency, amount);
    usdConverGet.text(`${value}$`)

  }

  async function  convertToSendValue(currency: string, amount: number) {
    currencyConvertSend.text(`${amount} ${currency}`);
    const value = await getConvetredToUSD(currency, amount);
    usdConverSend.text(`${value}$`)
  }

  async function getSettings(currencyFrom: string, currencyTo: string): Promise<ISettingData> {
    try {
      selectItem(labelCurrencyYouSend, cryptoYouSendCurrency);
      selectItem(labelCurrencyYouGet, cryptoYouGetCurrency);
      const res = await getCurrencySettings(currencyFrom, currencyTo);
      return res.data;
    } catch (e) {
      errorHandler()
      throw e;
    }
  }

  function errorHandler() {
    cryptoYouGetAmount = 0;
    cryptoYouSendAmount = 0;
    cryptoYouSend.val('Недоступный вариант обмена!');
    cryptoYouGet.val('Недоступный вариант обмена!');
  }

  async function changeYouSendValue(value:string | number) {
    try {
      cryptoYouSendAmount = Number(value);
      cryptoYouSend.val(value)
      loadingYouGetCurrency(true);
      convertToSendValue(cryptoYouSendCurrency.name, cryptoYouSendAmount)
      const data = await getEstimate(cryptoYouSendCurrency.name, cryptoYouGetCurrency.name, cryptoYouSendAmount);
      cryptoYouGetAmount = data.amount;
      cryptoYouGet.val(cryptoYouGetAmount);
      loadingYouGetCurrency(false);
      convertToGetValue(cryptoYouGetCurrency.name, cryptoYouGetAmount)

    } catch (e) {
      errorValidator(e);
      loadingYouGetCurrency(false);
      errorHandler()
    }

  }


  async function changeYouGetValue(value:number | string) {
    try {
      cryptoYouGetAmount = Number(value);
      cryptoYouGet.val(value);
      loadingYouSendCurrency(true);
      convertToGetValue(cryptoYouGetCurrency.name, cryptoYouGetAmount);
      const data = await getEstimate(cryptoYouSendCurrency.name, cryptoYouGetCurrency.name, Number(value), 1);
      cryptoYouSendAmount = data.amount;
      cryptoYouSend.val(cryptoYouSendAmount)
      loadingYouSendCurrency(false)
      convertToSendValue(cryptoYouSendCurrency.name, cryptoYouSendAmount);
    } catch (e) {
      loadingYouSendCurrency(false);
      errorHandler()
    }

  }

  async function reverseCurrency() {
    debugger;
    swapCurrencies();
    getDefaultData();
  }

  async function handleCryptoYouSendInput(this: HTMLInputElement) {
    const value = $(this).val()?.toString().replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    $(this).val(value as string);
    const changedNumber = Number(value);
    const currencyYouSendMaxAmount = Number(currencyYouSendMax.text());
    const currencyYouSendMinAmount = Number(currencyYouSendMin.text());
    const isGreaterThanMax = changedNumber > currencyYouSendMaxAmount;
    const isLessThanMin = changedNumber < currencyYouSendMinAmount

    if (isGreaterThanMax || isLessThanMin) {
      cryptoYouSend.parent().toggleClass('input--error');
      currencyYouSendMax.parent().toggleClass('welcome__limit-error', isGreaterThanMax);
      currencyYouSendMin.parent().toggleClass('welcome__limit-error', isLessThanMin);

      setTimeout(() => {
        cryptoYouSend.parent().removeClass('input--error');
          currencyYouSendMax.parent().removeClass('welcome__limit-error');
          currencyYouSendMin.parent().removeClass('welcome__limit-error');
      }, 1000);
    }


    if (Number(value) !== cryptoYouSendAmount) {
        if(value) {
            changeYouSendValue(value);
        }
    }
  }

  async function handleCryptoYouGetInput(this: HTMLInputElement) {
    const value = $(this).val()?.toString().replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    $(this).val(value as string);

    const changedNumber = Number(value);
    const currencyYouGetMaxAmount = Number(currencyYouGetMax.text());
    const currencyYouGetMinAmount = Number(currencyYouGetMin.text());
    const isGreaterThanMax = changedNumber > currencyYouGetMaxAmount;
    const isLessThanMin = changedNumber < currencyYouGetMinAmount

    if (isGreaterThanMax || isLessThanMin) {
      cryptoYouGet.parent().toggleClass('input--error');
      currencyYouGetMax.parent().toggleClass('welcome__limit-error', isGreaterThanMax);
      currencyYouGetMin.parent().toggleClass('welcome__limit-error', isLessThanMin);

      setTimeout(() => {
        cryptoYouGet.parent().removeClass('input--error');
        currencyYouGetMax.parent().removeClass('welcome__limit-error');
        currencyYouGetMin.parent().removeClass('welcome__limit-error');
      }, 1000);
    }

    if (Number(value) !== cryptoYouGetAmount) {
        if(value) {
            changeYouGetValue(value);
        }
    }
  }

  function handleFillList() {
    axios.get(getCurrenciesApi(window.language ? window.language : "ru"))
      .then(res => {
        const currenciesList:ICurrency[] = res.data;

        currenciesList.forEach(currency => {
          const $listItem = $(getHTMLListItem(currency));
          $listItem.on('click', function() {
            selectListItem.call(this, currency);
          })
          $('.crypto-form__exchange-form').find('.custom-select__select-list').append($listItem);
        })
      })
  }

  async function selectSendCurrency(currency: ICurrency) {
    try {
      if(currency.name === cryptoYouGetCurrency.name || (cryptoYouSendAmount === 0 && cryptoYouGetAmount === 0)) {
        if (currency.name === cryptoYouGetCurrency.name) {
          swapCurrencies();
        } else {
          cryptoYouSendCurrency = currency;
        }
      } else {
        cryptoYouSendCurrency = currency;
      }
      const data = await getSettings(cryptoYouSendCurrency.name, cryptoYouGetCurrency.name);
      currencyYouSendMin.text(data.min_amount);
      currencyYouSendMax.text(data.max_amount);
      console.log(data);
      
      changeYouSendValue(Number(data.min_amount));
    } catch (e) {
      loadingYouGetCurrency(false);
      loadingYouSendCurrency(false);
      errorHandler()
    }
  }

  async function selectGetCurrency(currency: ICurrency) {
    try {

      if(currency.name === cryptoYouSendCurrency.name || (cryptoYouSendAmount === 0 && cryptoYouGetAmount === 0)) {
        if (currency.name === cryptoYouSendCurrency.name) {
          swapCurrencies();
        } else {
          cryptoYouGetCurrency = currency;
        }
      } else {
        cryptoYouGetCurrency = currency;
      }
      const data = await getSettings(cryptoYouSendCurrency.name, cryptoYouGetCurrency.name);
      currencyYouSendMin.text(data.min_amount);
      currencyYouSendMax.text(data.max_amount);
      changeYouSendValue(Number(data.min_amount));
    } catch(e) {
      loadingYouGetCurrency(false);
      loadingYouSendCurrency(false);
      errorHandler()
    }
  }

  async function selectListItem (this: HTMLElement, currency: ICurrency) {
    const parentSelect = $(this).closest('.custom-select__select-container');
    const isCurrencyYouSend = parentSelect.data('currency') === 'cryptoYouSendSelect';
    select.find('.custom-select__select-list')?.toggleClass('hide');
    select.toggleClass('active');

    if(isCurrencyYouSend && currency.name !== cryptoYouSendCurrency.name) {
      selectSendCurrency(currency);
    } else if(!isCurrencyYouSend && currency.name !== cryptoYouGetCurrency.name) {
      selectGetCurrency(currency);
    }
  }

  async function getDefaultData() {
    try {
      loadingYouSendCurrency(true);
      loadingYouGetCurrency(true);
      const sendData = await getSettings(cryptoYouSendCurrency.name, cryptoYouGetCurrency.name);
      currencyYouSendMin.text(sendData.min_amount);
      currencyYouSendMax.text(sendData.max_amount);
      convertToSendValue(cryptoYouSendCurrency.name, sendData.min_amount)
      loadingYouGetCurrency(false);
      loadingYouSendCurrency(false);
      changeYouSendValue(Number(sendData.min_amount))
    } catch(e) {
      loadingYouGetCurrency(false);
      loadingYouSendCurrency(false);
      errorHandler()
    }
  }

  function swapCurrencies() {
    const tmp = cryptoYouGetCurrency;
    cryptoYouGetCurrency = cryptoYouSendCurrency;
    cryptoYouSendCurrency = tmp;
  }

  handleFillList();
  getDefaultData()
})

