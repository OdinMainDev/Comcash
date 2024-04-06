import Swiper from 'swiper';
import 'swiper/css';
import $ from 'jquery';
import { ICurrency, IDirection, IRate } from './models/interfaces';
import { getCurrencies, getDirections, getRatessApi } from './api/getDirectionApi';
import { filterByTag, findRateByCurrency } from './helpers/filter';
import axios from 'axios';

$(document).ready(function () {
  let currencies: ICurrency[] = [];
  let defaultCurrency = 'BTC';
  const leftExchangeColumnList = $('.welcome__exchange-mobile-side_left-list > .swiper-wrapper');
  const rightExchangeColumnList = $('.welcome__exchange-mobile-side_right-list > .swiper-wrapper');

  const exchangeCurrencyFrom = $('#exchangeCurrencyFromMobile');
  const exchangeCurrencyTo = $('#exchangeCurrencyToMobile');
  const exchangeCurrencyAmout = $('#exchangeCurrencyAmoutMobile');
  let rates: IRate[] = [];
  const filterItem = $('.welcome__exchange-mobile-side > .welcome__exchange-filter > .welcome__exchange-filter-item');

  filterItem.on('click', function() {
    filterItem.removeClass('active');
    $(this).addClass('active');
    drawRightColumns(defaultCurrency, $(this).data('filter'));
  })

;

  function generateHTMLLeftItem(currency: ICurrency) {
    return `
      <div class="swiper-slide" data-name=${currency.name}>
        <div class="welcome__exchange-item-content">
            <div class="flex items-center">
                <img  class="welcome__exchange-img" src="${currency.image}">
                <div class="welcome__exchange-name big">
                  ${currency.name}
                </div>
            </div>
        </div>
      </div>
    `
  };

  function generateHTMLRightItem(direction: IDirection) {
    return `
    <div class="swiper-slide" data-amount="${direction.data.min_amount}" data-name="${direction.currency_to.name}">
      <div class="welcome__exchange-item-content">
        <img  class="welcome__exchange-img" src="${direction.currency_to.image}">
        <div class="flex-1 flex flex-col">
          <div class="welcome__exchange-name big">
            ${direction.currency_to.name}
          </div>
          <div class="welcome__exchange-course">
            <div class="welcome__exchange-name">
                Курс: 1 - ${findRateByCurrency(defaultCurrency, direction.currency_to.name, rates)}
            </div>
          </div>
        </div>

      </div>
    </div>
    `
  };

  async function getRates() {
    try {
      const {data} = await axios.get<IRate[]>(getRatessApi());
      rates = data;
      drawRightColumns(defaultCurrency);
    } catch(e) {
      console.log(e);
    }
  }

  async function drawRightColumns(currencyName:string, tag = "all") {
    let directions: IDirection[] = (await getDirections()).filter(item => item.currency_from.name === currencyName) || [];
    let filtredDirection = tag !== "all" ? directions.filter(item => item.currency_to.tag === tag) : directions
    rightExchangeColumnList.html('');
    let rightSlider:Swiper;
    $.each(filtredDirection, function(_, item) {
      const listItem = $(generateHTMLRightItem(item));
      $(listItem).on('click', function() {
        const slideIndex = $(this).data("swiper-slide-index")
        rightSlider.slideToLoop(slideIndex);
      })
      rightExchangeColumnList.append(listItem)
    });
  
    rightSlider = new Swiper(".welcome__exchange-mobile-side_right-list", {
      slidesPerView: 3,
      loop: filtredDirection.length > 0,
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      direction: 'vertical',
      coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 800,
        modifier: 1,
        slideShadows: false
      },
      on: {
        slideChange: function(swiper) {
          const activeSlide = swiper.slides[swiper.activeIndex];
          const name = $(activeSlide).data('name');
          const amount = $(activeSlide).data('amount');
          exchangeCurrencyTo.val(name);
          exchangeCurrencyAmout.val(amount)
        }
      }
    })

  }

  async function drawLeftColumns () {
    currencies = await getCurrencies();
    const cryptoCurrencies = filterByTag(currencies, "crypto");
    leftExchangeColumnList.html('');
    let leftSlider: Swiper;
    $.each(cryptoCurrencies, function(_, item) {
      const listItem = $(generateHTMLLeftItem(item));
      $(listItem).on('click', function() {
        const slideIndex = $(this).data("swiper-slide-index");
        leftSlider.slideToLoop(slideIndex);
      })
      leftExchangeColumnList.append(listItem)
    });
    leftSlider = new Swiper(".welcome__exchange-mobile-side_left-list", {
      slidesPerView: 3,
      loop: true,
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      direction: 'vertical',
      coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 800,
        modifier: 1,
        slideShadows: false
      },
      on: {
        slideChange: function(swiper) {
          const activeSlide = swiper.slides[swiper.activeIndex];
          defaultCurrency = $(activeSlide).data('name');
          exchangeCurrencyFrom.val(defaultCurrency);
          drawRightColumns(defaultCurrency);
        }
      }
    });
  }
  getRates();

  drawLeftColumns();


});