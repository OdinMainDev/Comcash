import axios from 'axios';
import $ from 'jquery';
import { getCurrenciesApi } from '../../shared/api/getCurrenciesApi';
import { getDirectionsApi, getRatessApi } from './api/getDirectionApi';
import { IDirection, ICurrency, IRate } from './models/interfaces';
import { filterByTag, findRateByCurrency } from './helpers/filter';

$(document).ready(function () {
  let currencies: ICurrency[] = [];
  let defaultCurrency = 'BTC';
  const exchangeCurrencyFrom = $('#exchangeCurrencyFrom');
  const exchangeCurrencyTo = $('#exchangeCurrencyTo');
  const exchangeCurrencyAmout = $('#exchangeCurrencyAmout');
  exchangeCurrencyFrom.val(defaultCurrency)
  const leftExchangeColumnList = $('.welcome__exchange-col_left > .welcome__exchange-col-list')
  const rightExchangeColumnList = $('.welcome__exchange-col_right > .welcome__exchange-col-list');
  const filterItem = $('.welcome__exchange-filter-item');
  let rates: IRate[] = [];

  filterItem.on('click', function() {
    filterItem.removeClass('active');
    $(this).addClass('active');
    drawRightColumns(defaultCurrency, $(this).data('filter'));
  })

  async function getCurrencies(): Promise<ICurrency[]> {
    try {
      const { data } = await axios.get<ICurrency[]>(getCurrenciesApi())
      return data;
    } catch(e) {
      console.log(e)
      return [];
    }
  }

  async function getRates() {
    try {
      const {data} = await axios.get<IRate[]>(getRatessApi());
      rates = data;
      drawRightColumns(defaultCurrency);
    } catch(e) {
      console.log(e);
    }
  }
  async function getDirections(): Promise<IDirection[]> {
    try {
      const { data } = await axios.get<{data: IDirection[]}>(getDirectionsApi())
      return data.data;
    } catch(e) {
      console.log(e)
      return [];
    }
  }

  function generateHTMLRightItem(direction: IDirection) {
    return `
    <button class="welcome__exchange-item welcome__exchange-item_to">
      <div class="welcome__exchange-item-content">
        <div class="flex items-center">
          <img  class="welcome__exchange-img" src="${direction.currency_to.image}">
          <div class="welcome__exchange-name">
            ${direction.currency_to.name}
          </div>
        </div>
        <div class="welcome__exchange-course">
          <div class="welcome__exchange-name">
              Курс: 1 - ${findRateByCurrency(defaultCurrency, direction.currency_to.name, rates)}
          </div>
          <div class="welcome__exchange-name">
              Резерв: ${direction.data.max_amount}
          </div>
          <div class="welcome__exchange-button" type="submit">
              ОБМЕНЯТЬ
          </div>
        </div>
      </div>
    </button>
    `
  };

  function generateHTMLLeftItem(currency: ICurrency) {
    return `
    <div class="${currency.name === defaultCurrency ? "welcome__exchange-item active" : "welcome__exchange-item"}">
      <div class="welcome__exchange-item-content">
        <div class="flex items-center">
          <img  class="welcome__exchange-img" src="${currency.image}">
          <div class="welcome__exchange-name">
              ${currency.name}
          </div>
        </div>
      </div>
    </div>
    `
  };

  async function drawRightColumns(currencyName:string, tag = "all") {
    let directions: IDirection[] = (await getDirections()).filter(item => item.currency_from.name === currencyName) || [];
    let filtredDirection = tag !== "all" ? directions.filter(item => item.currency_to.tag === tag) : directions
    rightExchangeColumnList.html('')
    $.each(filtredDirection, function(_, item) {
      
      const listItem = $(generateHTMLRightItem(item));

      listItem.on('click', function() {
        exchangeCurrencyTo.val(item.currency_to.name);
        exchangeCurrencyAmout.val(item.data.min_amount)
      })

      rightExchangeColumnList.append(listItem)
    });
  }

  async function drawLeftColumns () {
    currencies = await getCurrencies();
    const cryptoCurrencies = filterByTag(currencies, "crypto");
    leftExchangeColumnList.html('')
    $.each(cryptoCurrencies, function(_, item) {
      const listItem = $(generateHTMLLeftItem(item));

      listItem.on('click', function() {
        $('.welcome__exchange-item').removeClass('active');
        $(this).addClass('active');
        drawRightColumns(item.name)
        defaultCurrency = item.name;
        exchangeCurrencyFrom.val(item.name);
      })
      
      leftExchangeColumnList.append(listItem)
    });
  }



  getRates();

  drawLeftColumns();
})
