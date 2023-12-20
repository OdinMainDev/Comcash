import axios from 'axios';
import $ from 'jquery';
import { ICurrency } from '../../shared/models/interfaces/currency';
import { getCurrenciesApi } from '../../shared/api/getCurrenciesApi';
import { defaultCryptoYouPay, defaultCryptoYouBuy } from './constants';
import { getEstimate } from '../../shared/api/getEstimate';
import { getHTMLListItem, selectItem } from '@/shared/scripts/select';
import { getCurrencySettings } from '../exchageFormScripts/api/getCurrencySettings';
import { ISettingData } from '@/shared/models/interfaces/settings';

$(document).ready(function () {
  const cryptoFormSwitch = $('#cryptoFormSwitch');

  cryptoFormSwitch.on('change', function () {
    const isBuy = $(this).prop('checked');
    if (isBuy) {
      $(this).siblings('.crypto-form__switch-item:nth-child(2)').removeClass('active');
      $(this).siblings('.crypto-form__switch-item:nth-child(3)').addClass('active');
    } else {
      $(this).siblings('.crypto-form__switch-item:nth-child(2)').addClass('active');
      $(this).siblings('.crypto-form__switch-item:nth-child(3)').removeClass('active');
    }
  });

  const cryptoYouGetSelect = $('#cryptoYouBuySelect');
  const cryptoYouSendSelect = $('#cryptoYouPaySelect');
  const select = $('.custom-select__select-container');
  const buyAndSellForm = $('.crypto-form__buy-and-sell-form');
  const labelCurrencyYouSend = cryptoYouSendSelect.find('.custom-select__select-label');
  const labelCurrencyYouGet = cryptoYouGetSelect.find('.custom-select__select-label');
  const currencyYouSendMin = buyAndSellForm.find('.welcome__send-min > span');
  const currencyYouSendMax = buyAndSellForm.find('.welcome__send-max > span');
  const currencyYouGetMin = buyAndSellForm.find('.welcome__get-min > span');
  const currencyYouGetMax = buyAndSellForm.find('.welcome__get-max > span');
  
  const cryptoYouGet = $('#cryptoYouBuy');
  const cryptoYouSend = $('#cryptoYouPay');

  let cryptoYouGetCurrency: ICurrency = defaultCryptoYouBuy;
  let cryptoYouSendCurrency: ICurrency = defaultCryptoYouPay;

  let cryptoYouGetAmount = 0;
  let cryptoYouSendAmount = 0;


  cryptoYouSend.on('input', handleCryptoYouSendInput);
  cryptoYouGet.on('input', handleCryptoYouGetInput);

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

  async function changeYouSendValue(value:number) {
    cryptoYouSendAmount = value;
    cryptoYouSend.val(cryptoYouSendAmount)
    loadingYouGetCurrency(true);
    const data = await getEstimate(cryptoYouSendCurrency.name, cryptoYouGetCurrency.name, cryptoYouSendAmount);
    loadingYouGetCurrency(false);
    cryptoYouGetAmount = data.amount;
    cryptoYouGet.val(cryptoYouGetAmount)
  }


  async function changeYouGetValue(value:number) {
    cryptoYouGetAmount = value;
    cryptoYouGet.val(cryptoYouGetAmount);
    loadingYouSendCurrency(true);
    const data = await getEstimate(cryptoYouGetCurrency.name, cryptoYouSendCurrency.name, value);
    loadingYouSendCurrency(false);
    cryptoYouSendAmount = data.amount;
    cryptoYouSend.val(cryptoYouSendAmount)
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
      changeYouSendValue(Number(value));

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
      changeYouGetValue(Number(value));
    }
  }

  function handleFillList() {
    axios.get(getCurrenciesApi())
      .then(res => {
        const currenciesList:ICurrency[] = res.data;

        currenciesList.forEach(currency => {
          const $listItem = $(getHTMLListItem(currency));
          $listItem.on('click', function() {
            selectListItem.call(this, currency);
          })
          buyAndSellForm.find('.custom-select__select-list').append($listItem);
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
        const data = await getSettings(cryptoYouGetCurrency.name, cryptoYouSendCurrency.name);
        currencyYouGetMin.text(data.min_amount);
        currencyYouGetMax.text(data.max_amount);
      } else {
        cryptoYouSendCurrency = currency;
      }
      const data = await getSettings(cryptoYouSendCurrency.name, cryptoYouGetCurrency.name);
      currencyYouSendMin.text(data.min_amount);
      currencyYouSendMax.text(data.max_amount);
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
        const data = await getSettings(cryptoYouSendCurrency.name, cryptoYouGetCurrency.name);
        cryptoYouSendAmount = Number(data.min_amount);
        currencyYouSendMin.text(data.min_amount);
        currencyYouSendMax.text(data.max_amount);
      } else {
        cryptoYouGetCurrency = currency;
      }
      
  
      const data = await getSettings(cryptoYouGetCurrency.name, cryptoYouSendCurrency.name);
      currencyYouGetMin.text(data.min_amount);
      currencyYouGetMax.text(data.max_amount);
      changeYouSendValue(cryptoYouSendAmount);
    } catch(e) {
      loadingYouGetCurrency(false);
      loadingYouSendCurrency(false);
      errorHandler()
    }
  }

  async function selectListItem (this: HTMLElement, currency: ICurrency) {
    const parentSelect = $(this).closest('.custom-select__select-container');
    const isCurrencyYouSend = parentSelect.data('currency') === 'cryptoYouPaySelect';
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
      loadingYouGetCurrency(false);
      const getData = await getSettings(cryptoYouGetCurrency.name, cryptoYouSendCurrency.name);
      currencyYouGetMin.text(getData.min_amount);
      currencyYouGetMax.text(getData.max_amount);
      loadingYouSendCurrency(false);
      changeYouSendValue(sendData.min_amount)
    } catch(e) {
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



});