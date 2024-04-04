import Swiper from 'swiper';
import 'swiper/css';
import $ from 'jquery';
import { ICurrency } from './models/interfaces';
import { getCurrencies } from './api/getDirectionApi';
import { filterByTag } from './helpers/filter';

$(document).ready(function () {
  let currencies: ICurrency[] = [];
  let defaultCurrency = 'BTC';
  const leftExchangeColumnList = $('.welcome__exchange-mobile-side_left-list > .swiper-wrapper')
  const exchangeCurrencyFrom = $('#exchangeCurrencyFromMobile');
  const exchangeCurrencyTo = $('#exchangeCurrencyToMobile');
  const exchangeCurrencyAmout = $('#exchangeCurrencyAmoutMobile');
 
  function generateHTMLLeftItem(currency: ICurrency) {
    return `
      <div class="swiper-slide">
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

  async function drawLeftColumns () {
    currencies = await getCurrencies();
    const cryptoCurrencies = filterByTag(currencies, "crypto");
    leftExchangeColumnList.html('')
    $.each(cryptoCurrencies, function(_, item) {
      const listItem = $(generateHTMLLeftItem(item));

      listItem.on('click', function() {
        $('.welcome__exchange-item').removeClass('active');
        $(this).addClass('active');
        // drawRightColumns(item.name)
        defaultCurrency = item.name;
        exchangeCurrencyFrom.val(item.name);
      })
      
      leftExchangeColumnList.append(listItem)
    });
    new Swiper(".welcome__exchange-mobile-side-list", {
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
    });
  }

  drawLeftColumns();


});