
import $ from 'jquery';
// import './select.scss';
import { ICurrency } from '../../models/interfaces/currency';

$(document).ready(function () {
  const select = $('.custom-select__select-container');

  select.find('.dropdown-toggle').on('click', function () {
    debugger;
    select.find('.custom-select__select-list-container')?.toggleClass('hidden');
    select.toggleClass('active');
  });


  select.each(function() {
    const select = $(this);
    $(window).on('click', function(event: JQuery.ClickEvent<Window>) {
      if (!select.is(event.target) && select.has(event.target).length === 0) {
        select.find('.custom-select__select-list-container').addClass('hidden');
        select.removeClass('active');
      }
    });
  })

  select.on('click', '.custom-select__select-item', function() {
    $(this).closest('.custom-select__select-list-container').addClass('hidden');
    select.removeClass('active');
  });

  // select search

  $('.custom-select__search-field').on('input', function() {
    const searchText = $(this).val() as string;
    const parentList = $(this).closest('.custom-select__select-list-container');
    parentList.find('.custom-select__select-item').each(function() {
      const listItemText = $(this).text().toLowerCase();
      if (listItemText.indexOf(searchText.toLowerCase()) === -1) {
        $(this).hide();
      } else {
        $(this).show();
      }
    })
  })

});

export function selectItem(label: JQuery<HTMLElement>, currency: ICurrency) {
  label.next('div').val(currency.name)
  label.html(getHTMLSelectedItem(currency));
}

export function getHTMLListItem(currency: ICurrency): string {
  const url = window.location.href;
  const languagePattern = /\/(en|ru)\/?/;

  const match = url.match(languagePattern);
  if (match && (match[1] === 'en' || match[1] === 'ru')) {
    const languageAbbreviation: 'en' | 'ru' = match[1];
    return `
    <div class="custom-select__select-item dropdown-menu  top-full w-full rounded-b-[8px] bg-[#1F1F1F] shadow-[0px_4px_20px_0px_rgba(0,0,0,0.25)] z-20 text-white max-h-[240px] overflow-y-scroll"><div class="active dropdown-item px-4 h-[40px] hover:bg-[#333] flex items-center gap-2 cursor-pointer" data-text="Bitcoin BTC" data-color="bg-white">
        <img class="w-5 h-5 rounded-full bg-green-500 welcome-exchange__img" src="${currency.image}">
        <span class="text-sm">${currency.data.titles[languageAbbreviation]} 
          <span class="text-[#FFFFFF66]/40"></span>
        </span>
      </div>
    `
  }

  return `
    <div class="custom-select__select-item dropdown-menu  top-full w-full rounded-b-[8px] bg-[#1F1F1F] shadow-[0px_4px_20px_0px_rgba(0,0,0,0.25)] z-20 text-white max-h-[240px] overflow-y-scroll"><div class="active dropdown-item px-4 h-[40px] hover:bg-[#333] flex items-center gap-2 cursor-pointer" data-text="Bitcoin BTC" data-color="bg-white">
        <img class="w-5 h-5 rounded-full bg-green-500 welcome-exchange__img" src="${currency.image}">
        <span class="text-sm">${currency.data.titles.en} 
          <span class="text-[#FFFFFF66]/40"></span>
        </span>
      </div>
  `
}

export function getHTMLSelectedItem(currency: ICurrency): string {
  const url = window.location.href;
  const languagePattern = /\/(en|ru)\//;

  const match = url.match(languagePattern);
  if (match && (match[1] === 'en' || match[1] === 'ru')) {
    const languageAbbreviation: 'en' | 'ru' = match[1];
    return `

      <img src="${currency.image}"
        class="w-5 h-5 rounded-full bg-green-500 " /></span>
      <span class="text-sm " data-label="">
        <div class="">${currency.data.titles[languageAbbreviation]}</div>
        <span class="text-[#FFFFFF66]/40">

        </span>
      </span>

    `;
  }
  return `

      <img src="${currency.image}"
        class="w-5 h-5 rounded-full bg-green-500 " /></span>
      <span class="text-sm " data-label="">
        <div class="">${currency.data.titles.en}</div>
        <span class="text-[#FFFFFF66]/40">
        </span>
      </span>
  `;
}
