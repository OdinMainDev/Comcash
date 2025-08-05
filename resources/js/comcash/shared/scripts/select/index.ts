import $ from 'jquery';
import { ICurrency } from '../../models/interfaces/currency';

function setDropdownState($toggle: JQuery<HTMLElement>, isOpen: boolean) {
  const $container = $toggle.closest('.custom-select__select-container');
  const $arrow = $toggle.find('.dropdown-arrow');

  if (isOpen) {
    $arrow.addClass('rotate-180 stroke-[#06AB6B]').removeClass('stroke-white');
    $toggle
      .removeClass('bg-[#2A2A2A] rounded-full rounded-t-full')
      .addClass('bg-[#06AB6B] rounded-t-[10px] rounded-b-none');
    $container.addClass('active');
  } else {
    $arrow.removeClass('rotate-180 stroke-[#06AB6B]').addClass('stroke-white');
    $toggle
      .removeClass('bg-[#06AB6B] rounded-t-[10px] rounded-b-none')
      .addClass('bg-[#2A2A2A] rounded-full rounded-t-full');
    $container.removeClass('active');
  }
}

function toggleDropdown($toggle: JQuery<HTMLElement>) {
  const $container = $toggle.closest('.custom-select__select-container');
  const $list = $container.find('.custom-select__select-list-container');
  const isOpen = !$list.hasClass('hidden');

  $('.custom-select__select-list-container').addClass('hidden');
  $('.custom-select__select-container').removeClass('active');
  $('.dropdown-toggle').each((_, el) => setDropdownState($(el), false));

  if (!isOpen) {
    $list.removeClass('hidden');
    setDropdownState($toggle, true);
  }
}

function closeAllDropdowns() {
  $('.custom-select__select-list-container').addClass('hidden');
  $('.custom-select__select-container').removeClass('active');
  $('.dropdown-toggle').each((_, el) => setDropdownState($(el), false));
}

$(document).ready(function () {
  $(document)
    .on('click', '.dropdown-toggle', function (e) {
      e.stopPropagation();
      toggleDropdown($(this));
    })
    .on('click', '.custom-select__select-item', function () {
      closeAllDropdowns();
    })
    .on('input', '.custom-select__search-field', function () {
      const searchText = ($(this).val() as string).toLowerCase();
      $(this)
        .closest('.custom-select__select-list-container')
        .find('.custom-select__select-item')
        .each(function () {
          const text = $(this).text().toLowerCase();
          $(this).toggle(text.includes(searchText));
        });
    });

  $(window).on('click', closeAllDropdowns);
});

export function selectItem(label: JQuery<HTMLElement>, currency: ICurrency) {
  label.next('div').val(currency.name);
  label.html(getHTMLSelectedItem(currency));
}

export function getHTMLListItem(currency: ICurrency): string {
  const lang = getCurrentLanguage();
  return `
    <div class="custom-select__select-item dropdown-menu top-full w-full rounded-b-[8px] bg-[#1F1F1F] shadow-[0px_4px_20px_rgba(0,0,0,0.25)] z-20 text-white max-h-[240px] overflow-y-scroll">
      <div class="active dropdown-item px-4 h-[40px] hover:bg-[#333] flex items-center gap-2 cursor-pointer">
        <img class="w-5 h-5 rounded-full bg-green-500 welcome-exchange__img" src="${currency.image}">
        <span class="text-sm">${currency.data.titles[lang]}</span>
      </div>
    </div>
  `;
}

export function getHTMLSelectedItem(currency: ICurrency): string {
  const lang = getCurrentLanguage();
  return `
    <img src="${currency.image}" class="w-5 h-5 rounded-full bg-green-500" />
    <span class="text-sm" data-label="">
      <div>${currency.data.titles[lang]}</div>
    </span>
  `;
}

function getCurrentLanguage(): 'en' | 'ru' {
  const match = window.location.href.match(/\/(en|ru)\//);
  return match && (match[1] === 'en' || match[1] === 'ru') ? match[1] as 'en' | 'ru' : 'en';
}
