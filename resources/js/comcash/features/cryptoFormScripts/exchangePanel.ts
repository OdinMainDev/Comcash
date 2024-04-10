import $ from 'jquery';
import { ICurrency } from './models/interfaces';
import axios from 'axios';
import { getCurrenciesApi } from '@/shared/api/getCurrenciesApi';
import { defaultCryptoYouGet, defaultCryptoYouSend } from './constants';
import { getCurrencySettings } from '../exchageFormScripts/api/getCurrencySettings';
import { getEstimate } from '@/shared/api/getEstimate';

$(document).ready(async function() {
  const exchangePanelLeft = $('.exchnage-panel-left');
  const exchangePanelRight = $('.exchnage-panel-right');

  const currencyFromAmountInput = exchangePanelLeft.find('.welcome-exchange__input');
  const currencyToAmountInput = exchangePanelRight.find('.welcome-exchange__input');

  const select = $('.welcome-exchange__select');
  const selectedItem = select.find('.welcome-exchange__select-selected');
  const closeButton = select.find('.welcome-exchange__select-close');
  const leftSelectList = exchangePanelLeft.find('.welcome-exchange__select-list');
  const rightSelectList = exchangePanelRight.find('.welcome-exchange__select-list');
  const leftPanelTitle = exchangePanelLeft.find('.welcome-exchange__block-subtitle > span');
  const rightPanelTitle = exchangePanelRight.find('.welcome-exchange__block-subtitle > span');
  const currencyFromInput = exchangePanelLeft.find('input[name="currency_from"]')
  const currencyToInput = exchangePanelRight.find('input[name="currency_to"]');


  const leftSearch = exchangePanelLeft.find('.welcome-exchange__select-search');
  const leftFilterItem = exchangePanelLeft.find('.welcome-exchange__filter-item');

  const rightSearch = exchangePanelRight.find('.welcome-exchange__select-search');
  const rightFilterItem = exchangePanelRight.find('.welcome-exchange__filter-item');

  const fromTitle = $('.welcome-exchange__title_from');
  const toTitle = $('.welcome-exchange__title_to');

  const courseTitle = $('.welcome-exchange__block-title > span');


  let currenciesList: ICurrency[] = [];
  const lang = "en";
  let currencyFrom: ICurrency = defaultCryptoYouGet;
  let currencyTo: ICurrency = defaultCryptoYouSend;
  let currencyFromAmount = 0;
  let currencyToAmount = 0;

  let currentTimer: any = null;


  
  selectItem(leftSelectList, currencyFrom, "from");
  selectItem(rightSelectList, currencyTo, "to");

  currencyFromAmountInput.on('input', function(e) {
    const target = e.target as HTMLInputElement;
    changeFromAmount(target.value);
  })

  currencyToAmountInput.on('input', function(e) {
    const target = e.target as HTMLInputElement;
    changeToAmount(target.value);
  })

  $('.welcome-exchange__icon-reverse').on('click', reverse)

  function reverse() {
    let tmp = currencyFrom;
    currencyFrom = currencyTo;
    currencyTo = tmp;
    selectItem(leftSelectList, currencyFrom, "from");
    selectItem(rightSelectList, currencyTo, "to");
  }

  async function generateCourseTitle(currencyFrom: string, currencyTo: string, error?: boolean) {
    if (!error) {
      courseTitle.text(`1 ${currencyFrom} = ${0} ${currencyTo}`);

      if (currentTimer) {
        clearInterval(currentTimer);
        currentTimer = null;
      }
  
      startTimer(12, () => generateCourseTitle(currencyFrom, currencyTo));
      try {
        const initialData = await getEstimate(currencyFrom, currencyTo, 1);
        courseTitle.text(`1 ${currencyFrom} = ${initialData.amount} ${currencyTo}`);
      } catch (e) {
      }
    } else {
      clearInterval(currentTimer);
      courseTitle.text(`Недоступный вариант обмена!`);
      $('.welcome-exchange__timer-clock').text(`00:00`);
    }

  }
  

  function startTimer(duration: number, onComplete: () => void) {
    let remainingSeconds = duration;
    updateTimer(remainingSeconds);
  
    currentTimer = setInterval(() => {
      remainingSeconds -= 1;
      updateTimer(remainingSeconds);
  
      if (remainingSeconds < 0) {
        clearInterval(currentTimer);
        $('.welcome-exchange__timer-clock').text(`00:00`);
        currentTimer = null;
        if (typeof onComplete === 'function') {
          onComplete(); 
        }
      }
    }, 1000);
  }

  function updateTimer(seconds: number) {
    const minutes = Math.floor(seconds / 60);
    const secs = seconds % 60;
    const formattedTime = `${minutes < 10 ? '0' : ''}${minutes}:${secs < 10 ? '0' : ''}${secs}`;
    $('.welcome-exchange__timer-clock').text(formattedTime);
  }

  const changeFromAmount = async (amount: string) => {
    let value = amount.replace(/[^\d.-]/g, '');
    currencyFromAmountInput.val(value);
    currencyFromAmount = Number(value);
    try {
      const data = await getEstimate(currencyFrom.name, currencyTo.name, Number(value));
      currencyToAmount = data.amount;
      currencyToAmountInput.attr('placeholder', `Min amount: ${data.min_amount}`);
    } catch (e) {

    }
    currencyToAmountInput.val(currencyToAmount);
  }

  const changeToAmount = async (amount: string) => {
    let value = amount.replace(/[^\d.-]/g, '');
    currencyToAmountInput.val(value);
    currencyToAmount = Number(value);
    try {
      const data = await getEstimate(currencyFrom.name, currencyTo.name, Number(value), 1);
      currencyFromAmount = data.amount;
      currencyFromAmountInput.val(currencyFromAmount);
    } catch (e) {

    }

  }

  //<------------select----------------->

  function toggleBodyScroll() {
    if ($('.welcome-exchange__select-list.active').length > 0 && Number($(window).width()) <= 768) {
      $('body').css('overflow', 'hidden');
    } else {
      $('body').css('overflow', '');
    }
  }

  function selectItem(element: JQuery, item: ICurrency, type: "to" | "from") {
    $(element).closest('.welcome-exchange__select')
      .find('.welcome-exchange__select-selected')
      .find('.welcome-exchange__select-selected-value')
      .html(`
        <img src="${item.image}" class="welcome-exchange__img"/>
        <div class="welcome-exchange__name">${item.data.titles[lang]}</div>
      `);  
    if(type === "from") {
      currencyFrom = item;
      fromTitle.text(currencyFrom.data.titles[lang]);
      leftPanelTitle.text(currencyFrom.data.titles[lang])
      currencyFromInput.val(currencyFrom.name);
      getSettings(item, currencyTo);
    } else if(type === "to") {
      currencyTo = item;
      toTitle.text(currencyTo.data.titles[lang]);
      currencyToInput.val(currencyTo.name);
      rightPanelTitle.text(currencyTo.data.titles[lang]);
      getSettings(currencyFrom, item);
    }


  }

  function closeSelectModal() {
    selectedItem.next().removeClass('active');
    selectedItem.find('.welcome-exchange__arrow').removeClass('active');
  }
  
  selectedItem.on('click', function(event) {
    event.stopPropagation();
    $(this).next().toggleClass('active');
    toggleBodyScroll();
    $(this).find('.welcome-exchange__arrow').toggleClass('active')
    selectedItem.next().not($(this).next()).removeClass('active');
    $('.welcome-exchange__arrow').not($(this).find('.welcome-exchange__arrow')).removeClass('active');
  });

  closeButton.on('click', function() {
    toggleBodyScroll();
    $(this).closest('.welcome-exchange__select').find('.welcome-exchange__select-list').removeClass('active');
    $(this).closest('.welcome-exchange__select').find('.welcome-exchange__arrow').removeClass('active');
    toggleBodyScroll();
  })

  selectedItem.next().on('click', function(event) {
    event.stopPropagation();
  });

  $(document).on('click', function(e) {
    selectedItem.next().removeClass('active');
    selectedItem.find('.welcome-exchange__arrow').removeClass('active');
  });
  $(window).resize(toggleBodyScroll);

  //<------------select----------------->
  

  const getCurrencies = async (): Promise<ICurrency[]> => {
    try {
      const {data} = await axios.get<ICurrency[]>(getCurrenciesApi());
      return data;
    } catch (e) {
      return [];
    }
  }

  const generateSelectItem = (currency: ICurrency, is_active?: boolean) => {
    return `
    <div class="welcome-exchange__list-item ${is_active ? "active" : ''}">
      <div class="flex items-center gap-[10px]">
          <img src="${currency.image}" class="welcome-exchange__img"/>
          <div class="welcome-exchange__name">${currency.data.titles[lang]}</div>
      </div>
      <div class="welcome-exchange__list-check">
          <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 28 28" fill="none">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M14 28C21.732 28 28 21.732 28 14C28 6.26801 21.732 0 14 0C6.26801 0 0 6.26801 0 14C0 21.732 6.26801 28 14 28ZM20.9909 9.97352C21.3444 9.54924 21.2871 8.91868 20.8628 8.56511C20.4386 8.21155 19.808 8.26887 19.4544 8.69315L13.0787 16.344C12.732 16.7601 12.5371 16.9904 12.3815 17.132L12.3755 17.1374L12.3691 17.1325C12.2013 17.0057 11.9863 16.7939 11.6034 16.411L8.48532 13.2929C8.09479 12.9024 7.46163 12.9024 7.07111 13.2929C6.68058 13.6834 6.68058 14.3166 7.07111 14.7071L10.1892 17.8252L10.23 17.866L10.23 17.866C10.5565 18.1926 10.8706 18.5068 11.1628 18.7278C11.4902 18.9754 11.9189 19.2081 12.4683 19.1832C13.0177 19.1583 13.4236 18.8876 13.7272 18.6115C13.9982 18.365 14.2826 18.0236 14.5781 17.6688L14.5782 17.6688L14.6151 17.6244L20.9909 9.97352Z" fill="#009C74"/>
          </svg>
      </div>
    </div>
    `
  }

  async function getSettings (currencyFrom: ICurrency, currencyTo: ICurrency) {
    try {
      const {data} = await getCurrencySettings(currencyFrom.name, currencyTo.name);
      currencyToAmountInput.prop('disabled', false);
      currencyFromAmountInput.prop('disabled', false);
      changeFromAmount(data.min_amount.toString());
      currencyFromAmountInput.attr('placeholder', `Min amount: ${data.min_amount}`);
      generateCourseTitle(currencyFrom.name, currencyTo.name);
    } catch(e) {
      generateCourseTitle(currencyFrom.name, currencyTo.name, true);

      currencyFromAmountInput.val('Недоступный вариант обмена!');
      currencyToAmountInput.val('Недоступный вариант обмена!');
      currencyFromAmountInput.attr('placeholder', 'Недоступный вариант обмена!');
      currencyToAmountInput.attr('placeholder', 'Недоступный вариант обмена!');
      currencyToAmountInput.prop('disabled', true);
      currencyFromAmountInput.prop('disabled', true);


    }
  }

  currenciesList = await getCurrencies();
  let rightList = currenciesList;
  let rightFilter = 'all';
  let rightSearchText = '';
  
  let leftList = currenciesList;
  let leftFilter = 'all';
  let leftSearchText = '';

  const removeActive = (element: JQuery) => {
    $(element).closest('.welcome-exchange__select').find('.welcome-exchange__list-item').removeClass('active');
  }

  const generateList = (list: ICurrency[], type: "from" | "to") => {
    $.each(list, (_, item) => {
      let listItem = $(generateSelectItem(item));
      if(item.name === currencyFrom.name) {
        listItem = $(generateSelectItem(item, true));
  
      } else {
        listItem = $(generateSelectItem(item));
      }
      listItem.on('click', function() {
        removeActive($(this));
        selectItem($(this), item, type)
        $(this).addClass('active');
        closeSelectModal();
      })
      if (type === "from") {
        leftSelectList.find('.welcome-exchange__list').append(listItem);
      } else {
        rightSelectList.find('.welcome-exchange__list').append(listItem);
      }
    });
  }

  generateList(leftList, "from");
  generateList(rightList, "to");

  leftSearch.on('input', function() {
    leftSearchText = $(this).val()?.toString().toLowerCase() as string;
    let filtredList = leftList.filter(item => item.data.titles[lang].toLowerCase().includes(leftSearchText));
    filtredList = leftFilter === "all" ? filtredList : filtredList.filter(item => item.tag === leftFilter);
    leftSelectList.find('.welcome-exchange__list').empty();
    generateList(filtredList, "from");
  });

  leftFilterItem.on('click', function() {
    leftSearchText = '';
    leftSearch.val(leftSearchText);
    leftFilterItem.removeClass('active');
    $(this).addClass('active');
    leftList = currenciesList;
    leftFilter = $(this).data('filter');
    let filtredList = leftList.filter(item => item.data.titles[lang].toLowerCase().includes(leftSearchText));
    filtredList = leftFilter === "all" ? filtredList : filtredList.filter(item => item.tag === leftFilter);
    leftSelectList.find('.welcome-exchange__list').empty();
    generateList(filtredList, "from");
  }) 

  rightSearch.on('input', function() {
    rightSearchText = $(this).val()?.toString().toLowerCase() as string;
    let filtredList = rightList.filter(item => item.data.titles[lang].toLowerCase().includes(rightSearchText));
    filtredList = rightFilter === "all" ? filtredList : filtredList.filter(item => item.tag === rightFilter);
    rightSelectList.find('.welcome-exchange__list').empty();
    generateList(filtredList, "to");
  });

  rightFilterItem.on('click', function() {
    rightSearchText = '';
    rightSearch.val(rightSearchText);
    rightFilterItem.removeClass('active');
    $(this).addClass('active');
    rightList = currenciesList;
    rightFilter = $(this).data('filter');
    let filtredList = rightList.filter(item => item.data.titles[lang].toLowerCase().includes(rightSearchText));
    filtredList = rightFilter === "all" ? filtredList : filtredList.filter(item => item.tag === rightFilter);
    rightSelectList.find('.welcome-exchange__list').empty();
    generateList(filtredList, "to");
  }) 




  
  
})