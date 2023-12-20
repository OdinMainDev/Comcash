import $ from 'jquery';

const isChristmas = window.isChristmasThemeComcash; 
const header = $('.header');
const welcome = $('.welcome');
const toys = $('.about__item-christmas-toy');
const courierContainer = $('.courier__container');
const newCard = $('.news__card');
const transactionsTable = $('.transactions__container');
const headerLogoDefault = $('.header__default');
const headerChristmas= $('.header__christmas');


if (isChristmas) {
  toys.show();
  courierContainer.addClass('сhristmas');
  header.addClass('сhristmas');
  welcome.addClass('сhristmas');
  newCard.addClass('сhristmas');
  transactionsTable.addClass('сhristmas');
  headerLogoDefault.hide();
  headerChristmas.show();
}
