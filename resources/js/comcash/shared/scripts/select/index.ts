
import $ from 'jquery';
import './select.scss';
import { ICurrency } from '../../models/interfaces/currency';

$(document).ready(function () {
  const select = $('.custom-select__select-container');

  select.find('.custom-select__select-label').on('click', function () {
    select.find('.custom-select__select-list-container')?.toggleClass('hide');
    select.toggleClass('active');
  });


  select.each(function() {
    const select = $(this);
    $(window).on('click', function(event: JQuery.ClickEvent<Window>) {
      if (!select.is(event.target) && select.has(event.target).length === 0) {
        select.find('.custom-select__select-list-container').addClass('hide');
        select.removeClass('active');
      }
    });
  })

  select.on('click', '.custom-select__select-item', function() {
    $(this).closest('.custom-select__select-list-container').addClass('hide');
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
  label.next('input').val(currency.name)
  label.html(getHTMLSelectedItem(currency));
}

export function getHTMLListItem(currency: ICurrency): string {
  const url = window.location.href;
  const languagePattern = /\/(en|ru)\/?/;

  const match = url.match(languagePattern);
  if (match && (match[1] === 'en' || match[1] === 'ru')) {
    const languageAbbreviation: 'en' | 'ru' = match[1];
    return `
      <div class="custom-select__select-item" >
        <img src="${currency.image}"/>
        <span>
          ${currency.data.titles[languageAbbreviation]}
        </span>
      </div>
    `
  }

  return `
    <div class="custom-select__select-item" >
      <img src="${currency.image}"/>
      <span>
        ${currency.data.titles.en}
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
      <div class="custom-select__select-selected">
        <img src="${currency.image}"/>
        <span>
          ${currency.data.titles[languageAbbreviation]}
        </span>
      </div>
    `;
  }
  return `
    <div class="custom-select__select-selected">
      <img src="${currency.image}"/>
      <span>
        ${currency.data.titles.en}
      </span>
    </div>
  `;
}
