import $ from 'jquery';
import { ICurrency } from './models/interfaces';

import { defaultCryptoYouGet, defaultCryptoYouSend } from './constants';
import { getCurrencySettings } from '../exchageFormScripts/api/getCurrencySettings';
import { getEstimate } from '@/shared/api/getEstimate';
import { getCurrencies, getCurrenciesFrom } from './api/getDirectionApi';
import { IEstimate } from '@/shared/models/interfaces/currency';

$(document).ready(async function() {
  const exchangePanelLeft = $('.exchnage-panel-left');
  const exchangePanelRight = $('.exchnage-panel-right');

  const currencyFromAmountInput = exchangePanelLeft.find('.welcome-exchange__input');
  const currencyToAmountInput = exchangePanelRight.find('.welcome-exchange__input');
  const usdFromHint = exchangePanelLeft.find("#usdFromHint");
  const usdToHint = exchangePanelRight.find("#usdToHint");
  let debounceTimer: any = null;
  let lastRequestController: AbortController | null = null;
  const select = $('.welcome-exchange__select');
  const selectedItem = select.find('.welcome-exchange__select-selected');
  const closeButton = select.find('.welcome-exchange__select-close');
  const leftSelectList = exchangePanelLeft.find('.welcome-exchange__select-list');
  const rightSelectList = exchangePanelRight.find('.welcome-exchange__select-list');
  const leftPanelTitle = exchangePanelLeft.find('.welcome-exchange__block-subtitle > span');
  const rightPanelTitle = exchangePanelRight.find('.welcome-exchange__block-subtitle > span');
  const currencyFromInput = exchangePanelLeft.find('input[name="currency_from"]');
  const currencyToInput = exchangePanelRight.find('input[name="currency_to"]');

  const leftSearch = exchangePanelLeft.find('.welcome-exchange__select-search');
  const leftFilterItem = exchangePanelLeft.find('.welcome-exchange__filter-item');

  const rightSearch = exchangePanelRight.find('.welcome-exchange__select-search');
  const rightFilterItem = exchangePanelRight.find('.welcome-exchange__filter-item');

  const leftLoader = exchangePanelLeft.find('.welcome-exchange__loading');
  const rightLoader = exchangePanelRight.find('.welcome-exchange__loading');

  const fromTitle = $('.welcome-exchange__title_from');
  const toTitle = $('.welcome-exchange__title_to');
  const courseFrom = $('.courseFrom');
  const courseTo = $('.courseTo');
  const courseTypeFrom = $('.courseTypeFrom');
  const courseTypeTo = $('.courseTypeTo');
  const timer = $('.exchangeTimer');
  
  leftLoader.show();
  rightLoader.show();
  let currenciesList: ICurrency[] = await getCurrencies();
  let currencyFromList = await getCurrenciesFrom();
  leftLoader.hide();
  rightLoader.hide();
  const timerFrom = null;

  let rightList = currenciesList;
  let rightFilter = 'all';
  let rightSearchText = '';

  let leftList = currencyFromList;
  let leftFilter = 'all';
  let leftSearchText = '';

  const generateSelectItem = (currency: ICurrency, is_active?: boolean) => {


    return `
      <div class="${is_active ? "active" : ''} dropdown-item px-4 h-[40px] hover:bg-[#333] flex items-center gap-2 cursor-pointer" data-text="${currency.data.titles[lang]}" data-color="bg-white">
        <img class="w-5 h-5 rounded-full bg-green-500 welcome-exchange__img" src="${currency.image}">
        <span class="text-sm">${currency.data.titles[lang]} 
          <span class="text-[#FFFFFF66]/40"></span>
        </span>
      </div>;
    `;

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
    `;
  }

  const generateList = (list: ICurrency[], type: "from" | "to", currency: ICurrency) => {
    const selectList = type === "from" ? leftSelectList : rightSelectList;
    selectList.find('.welcome-exchange__list').empty();

    $.each(list, (_, item) => {
      let listItem = $(generateSelectItem(item, item.name === currency.name));
      selectList.find('.welcome-exchange__list').append(listItem);

      listItem.on('click', function() {
        removeActive($(this));
        selectItem($(this), item, type);
        $(this).addClass('active');
        closeSelectModal();
      });
    });
  }



  const lang = window.language || 'en';
  let currencyFrom: ICurrency = currencyFromList[0] ?? defaultCryptoYouSend;
  let currencyTo: ICurrency = currenciesList[0] ?? defaultCryptoYouGet;
  if(currencyTo.id == currencyFrom.id) {
    currencyTo = currenciesList[1] ?? defaultCryptoYouGet;
  }
  let currencyFromAmount = 0;
  let currencyToAmount = 0;

  selectItem(leftSelectList, currencyFrom, "from");
  selectItem(rightSelectList, currencyTo, "to");

  let currentTimer: any = null;

  updateSelectionUI();

  currencyFromAmountInput.on('input', function(e) {
    const target = e.target as HTMLInputElement;
    changeFromAmount(target.value);
  });

  currencyToAmountInput.on('input', function(e) {
    const target = e.target as HTMLInputElement;
    changeToAmount(target.value);
  });

  $('.welcome-exchange__icon-reverse').on('click', executeReverse);


  async function generateCourseTitle(currencyFrom: string, currencyTo: string, error?: boolean) {
    if (!error) {

      if (currentTimer) {
        clearInterval(currentTimer);
        currentTimer = null;
      }

      startTimer(12, () => generateCourseTitle(currencyFrom, currencyTo, error));
      try {
        const initialData = await getEstimate(currencyFrom, currencyTo, 1);


        if (currencyTo == "CASHRUB") {
          currencyTo = "CASH";
        }


        courseFrom.text(`1 ${currencyFrom}`);
        courseTo.text(`${initialData.amount} ${currencyTo}`);
      } catch (e) {
        // Handle error
      }
    } else {
      clearInterval(currentTimer);
      courseFrom.text(`Недоступный вариант обмена!`);
      courseTypeFrom.text("");
      courseTypeTo.text("");
      courseTo.text("")
      timer.text(`00:00`);
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
        timer.text('00:00')
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

    timer.text(formattedTime)
  }

  async function UpdateUsdHint(target: string, quantity: number) {
      const esimate = await getEstimate(target, "USDTERC20", quantity);
      usdFromHint.text(esimate .amount);
      usdToHint.text(esimate .amount);
  }

  const changeFromAmount = async (amount: string) => {
    if (debounceTimer) clearTimeout(debounceTimer);

    debounceTimer = setTimeout(async () => {
      if (lastRequestController) lastRequestController.abort();
      lastRequestController = new AbortController();
      const { signal } = lastRequestController;

      let value = amount.replace(/[^\d.-]/g, '');
      currencyFromAmountInput.val(value);
      currencyFromAmount = Number(value);
      try {
        const quantity = Number(value);
        const data = await getEstimate(currencyFrom.name, currencyTo.name, quantity, undefined, signal);
        await UpdateUsdHint(currencyFrom.name, quantity);
        currencyToAmount = data.amount;
        currencyToAmountInput.attr('placeholder', `Min amount: ${data.min_amount}`);
      } catch (e) {
      } finally {
        rightLoader.hide();
      }
      currencyToAmountInput.val(currencyToAmount);
    }, 300);
  }

  const changeToAmount = async (amount: string) => {
    if (debounceTimer) clearTimeout(debounceTimer);

    debounceTimer = setTimeout(async () => {
      if (lastRequestController) lastRequestController.abort();
      lastRequestController = new AbortController();
      const { signal } = lastRequestController;

      let value = amount.replace(/[^\d.-]/g, '');
      currencyToAmountInput.val(value);
      currencyToAmount = Number(value);
      const quantity = Number(value);
      try {
        const data = await getEstimate(currencyFrom.name, currencyTo.name, Number(value), 1, signal);
        currencyFromAmount = data.amount;
        currencyFromAmountInput.val(currencyFromAmount);
      } catch (e) {
      }
    }, 300);
  }

  function toggleBodyScroll() {
    if ($('.welcome-exchange__select-list.active').length > 0 && Number($(window).width()) <= 768) {
      $('body').addClass('overflow-hidden');
    } else {
      $('body').removeClass('overflow-hidden');
    }
  }

  function selectItem(element: JQuery, item: ICurrency, type: "to" | "from") {
    const selectedValue = $(element).closest('.welcome-exchange__select')
      .find('.welcome-exchange__select-selected-value');

      const currentHtml = selectedValue.html();
      const newHtml = `
      <img src="${item.image}" class="w-5 h-5 rounded-full bg-green-500 welcome-exchange__img"/></span>
      <span class="text-sm " data-label="">
          <div class="welcome-exchange__name">${item.data.titles[lang]}</div>
          <span class="text-[#FFFFFF66]/40">
              
          </span>
      </span>
    `;

    if (currentHtml !== newHtml) {
      selectedValue.html(newHtml);
      $('body').removeClass('overflow-hidden');

      if (type === "from") {
          currencyFrom = item;
          fromTitle.text(currencyFrom.data.titles[lang]);
          leftPanelTitle.text(currencyFrom.data.titles[lang]);
          currencyFromInput.val(currencyFrom.name);
          getSettings(currencyFrom, currencyTo);
      } else if (type === "to") {
          currencyTo = item;
          toTitle.text(currencyTo.data.titles[lang]);
          currencyToInput.val(currencyTo.name);
          rightPanelTitle.text(currencyTo.data.titles[lang]);
          getSettings(currencyFrom, currencyTo);
      }
    }
  }

  function executeReverse() {
    let tmp = currencyFrom;
    currencyFrom = currencyTo;
    currencyTo = tmp;
    updateSelectionUI();
  }

  function updateSelectionUI() {
    const leftSelectList = $('.exchnage-panel-left');
    const rightSelectList = $('.exchnage-panel-right');

    leftSelectList.find('.welcome-exchange__select-selected-value').html(`
        <img src="${currencyFrom.image}" class="w-5 h-5 rounded-full bg-green-500 welcome-exchange__img"/>
        <span class="text-sm " data-label="">
            <div class="welcome-exchange__name">${currencyFrom.data.titles[lang]}</div>
            <span class="text-[#FFFFFF66]/40">
                
            </span>
        </span>
    `);

    rightSelectList.find('.welcome-exchange__select-selected-value').html(`

        <img src="${currencyTo.image}" class="w-5 h-5 rounded-full bg-green-500 welcome-exchange__img"/></span>
        <span class="text-sm " data-label="">
            <div class="welcome-exchange__name">${currencyTo.data.titles[lang]}</div>
            <span class="text-[#FFFFFF66]/40">
                
            </span>
        </span>
    `);

    fromTitle.text(currencyFrom.data.titles[lang]);
    leftPanelTitle.text(currencyFrom.data.titles[lang]);
    currencyFromInput.val(currencyFrom.name);

    toTitle.text(currencyTo.data.titles[lang]);
    rightPanelTitle.text(currencyTo.data.titles[lang]);
    currencyToInput.val(currencyTo.name);

    selectItem(leftSelectList, currencyFrom, "from");
    selectItem(rightSelectList, currencyTo, "to");
  }

  function closeSelectModal() {
    selectedItem.next().addClass('hidden');
    HideDropDown(selectedItem)
  }
  function HideDropDown(selected: JQuery<HTMLElement>) {
    const arrow = selected.find('.welcome-exchange__arrow');
    arrow
        .removeClass("rotate-180 stroke-[#06AB6B]")
        .addClass("stroke-white");

    selected
        .removeClass("bg-[#06AB6B] rounded-t-[10px] rounded-b-none")
        .addClass("bg-[#2A2A2A] rounded-full rounded-t-full");
  }
  function OpenDropDown(selected: JQuery<HTMLElement>) {

    const arrow = selected.find('.welcome-exchange__arrow');
      arrow
          .addClass("rotate-180 stroke-[#06AB6B]")
          .removeClass("stroke-white");
  
      selected
          .removeClass("bg-[#2A2A2A] rounded-full rounded-t-full")
          .addClass("bg-[#06AB6B] rounded-t-[10px] rounded-b-none");
  }


  function UpdateDropdownStyleState(selected: JQuery<HTMLElement>) {
    const list = selected.next();
    const isOpen = !list.hasClass("hidden");
    if (isOpen) {
      HideDropDown(selected);
    } else {
      OpenDropDown(selected);
    }
    list.toggleClass("hidden");
  }

  selectedItem.on('click', function(event) {
    event.stopPropagation();
    toggleBodyScroll();
    UpdateDropdownStyleState($(this))
    
  });

  closeButton.on('click', function() {
    $(this).closest('.welcome-exchange__select').find('.welcome-exchange__select-list').removeClass('active');
    $(this).closest('.welcome-exchange__select').find('.welcome-exchange__arrow').removeClass('active');
    toggleBodyScroll();
    UpdateDropdownStyleState($(this))
  });

  selectedItem.next().on('click', function(event) {
    event.stopPropagation();
  });

  $(document).on('click', function() {
    selectedItem.next().addClass('hidden');
    selectedItem.find('.welcome-exchange__arrow').removeClass('active');
    toggleBodyScroll();
    HideDropDown(selectedItem);
  });

  $(window).resize(toggleBodyScroll);




  async function getSettings(currencyFrom: ICurrency, currencyTo: ICurrency) {
    try {
      const { data } = await getCurrencySettings(currencyFrom.name, currencyTo.name);
      currencyToAmountInput.prop('disabled', false);
      currencyFromAmountInput.prop('disabled', false);
      changeFromAmount(data.min_amount.toString());
      currencyFromAmountInput.attr('placeholder', `Min amount: ${data.min_amount}`);
      generateCourseTitle(currencyFrom.name, currencyTo.name);
    } catch (e) {
      generateCourseTitle(currencyFrom.name, currencyTo.name, true);
      usdFromHint.val('Недоступный вариант обмена!');
      usdToHint.val('Недоступный вариант обмена!');
      currencyFromAmountInput.val('Недоступный вариант обмена!');
      currencyToAmountInput.val('Недоступный вариант обмена!');
      currencyFromAmountInput.attr('placeholder', 'Недоступный вариант обмена!');
      currencyToAmountInput.attr('placeholder', 'Недоступный вариант обмена!');
      currencyToAmountInput.prop('disabled', true);
      currencyFromAmountInput.prop('disabled', true);
    }
  }


  const removeActive = (element: JQuery) => {
    $(element).closest('.welcome-exchange__select').find('.welcome-exchange__list-item').removeClass('active');
  }


  generateList(leftList, "from", currencyFrom);
  generateList(rightList, "to", currencyTo);

  leftSearch.on('input', function() {
    leftSearchText = $(this).val()?.toString().toLowerCase() as string;
    let filteredList = leftList.filter(item => item.data.titles[lang].toLowerCase().includes(leftSearchText));
    filteredList = leftFilter === "all" ? filteredList : filteredList.filter(item => item.tag === leftFilter);
    leftSelectList.find('.welcome-exchange__list').empty();
    generateList(filteredList, "from", currencyFrom);
  });

  leftFilterItem.on('click', function() {
    leftSearchText = '';
    leftSearch.val(leftSearchText);
    leftFilterItem.removeClass('active');
    $(this).addClass('active');
    leftList = currencyFromList;
    leftFilter = $(this).data('filter');
    let filteredList = leftList.filter(item => item.data.titles[lang].toLowerCase().includes(leftSearchText));
    filteredList = leftFilter === "all" ? filteredList : filteredList.filter(item => item.tag === leftFilter);
    leftSelectList.find('.welcome-exchange__list').empty();
    generateList(filteredList, "from", currencyFrom);
  });

  rightSearch.on('input', function() {
    rightSearchText = $(this).val()?.toString().toLowerCase() as string;
    let filteredList = rightList.filter(item => item.data.titles[lang].toLowerCase().includes(rightSearchText));
    filteredList = rightFilter === "all" ? filteredList : filteredList.filter(item => item.tag === rightFilter);
    rightSelectList.find('.welcome-exchange__list').empty();
    generateList(filteredList, "to", currencyTo);
  });

  rightFilterItem.on('click', function() {
    rightSearchText = '';
    rightSearch.val(rightSearchText);
    rightFilterItem.removeClass('active');
    $(this).addClass('active');
    rightList = currenciesList;
    rightFilter = $(this).data('filter');
    let filteredList = rightList.filter(item => item.data.titles[lang].toLowerCase().includes(rightSearchText));
    filteredList = rightFilter === "all" ? filteredList : filteredList.filter(item => item.tag === rightFilter);
    rightSelectList.find('.welcome-exchange__list').empty();
    generateList(filteredList, "to", currencyTo);
  });



  const activeStyles = [
    "bg-[linear-gradient(0deg,_rgba(30,30,30,0.6),_rgba(30,30,30,0.6)),_linear-gradient(0deg,_rgba(6,171,107,0.05),_rgba(6,171,107,0.05))]",
    "border-[#06AB6B]",
    "transition-all",
    "duration-300",
    "bg-[#2A2A2A]"
  ];
  
  const defaultStyles = [
    "border-[#FFFFFF1A]/10",
    "bg-[#1B1B1B]"
  ];
  
  function setupFocusEffects() {
    $("[data-focus-target]").each(function () {
      const $trigger = $(this);
      const targetSelector = $trigger.data("focus-target");
      const $target = $(targetSelector);
      if ($target.length === 0) return;
  
      const activate = () => {
        $target.removeClass(defaultStyles.join(" "))
               .addClass(activeStyles.join(" "));
      };
  
      const deactivate = () => {
        $target.removeClass(activeStyles.join(" "))
               .addClass(defaultStyles.join(" "));
      };
  
      $trigger.on("focus click", activate);
      $trigger.on("blur", deactivate);
      $(document).on("click", (e) => {
        const target = e.target;
      
        if (!(target instanceof HTMLElement)) return;
      
        if (
          !$trigger.is(target) && $trigger.has(target).length === 0 &&
          !$target.is(target) && $target.has(target).length === 0
        ) {
          deactivate();
        }
      });
      
      
      
    });
  }
  
  setupFocusEffects();
  
    const $openConverter = $("#openConverter");
    const $closeConverter = $("#closeConverter");
    const $converterModal = $("#converterModal");
    const $converterInner = $("#converterInner");

    if ($openConverter.length && $closeConverter.length && $converterModal.length && $converterInner.length) {
        
        $openConverter.on("click", function () {
            $converterModal.removeClass("hidden");

            $("body").css({
                overflow: "hidden",
                height: "100vh"
            });

            setTimeout(function () {
                $converterInner.removeClass("translate-y-full").addClass("translate-y-0");
            }, 20);
        });

        $closeConverter.on("click", closeModal);

        $converterModal.on("click", function (e) {
            if (e.target === this) {
                closeModal();
            }
        });

        $(window).on("resize", function () {
          if (($(window).width() ?? 0) >= 760 && $converterModal.length && !$converterModal.hasClass("hidden")) {
              closeModal();
          }
        
        });

        function closeModal() {
            $converterInner.removeClass("translate-y-0").addClass("translate-y-full");

            setTimeout(function () {
                $converterModal.addClass("hidden");
                $("body").css({
                    overflow: "",
                    height: ""
                });
            }, 300);
        }
    }
});


