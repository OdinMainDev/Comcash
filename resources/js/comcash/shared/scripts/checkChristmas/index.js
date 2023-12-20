import $ from 'jquery';

const isChristmas = window.isChristmasThemeComcash; 
const header = $('.header');
const welcome = $('.welcome');
const toys = $('.about__item-christmas-toy');
const courierContainer = $('.courier__container');
const newCard = $('.news__card');
const transactionsContainer = $('.transactions__container');
const headerLogoDefault = $('.header__default');
const headerChristmas= $('.header__christmas');
const aboutChristmas = $('.about__item');
const courierSnowdrift = $('.courier__box-snowdrift');
const transactionsTable = $('.transactions__table');

if (isChristmas) {
  toys.show();
  courierContainer.addClass('сhristmas');
  header.addClass('сhristmas');
  welcome.addClass('сhristmas');
  newCard.addClass('сhristmas');
  transactionsContainer.addClass('сhristmas');
  aboutChristmas.addClass('christmas')
  transactionsTable.addClass('christmas')
  headerLogoDefault.hide();
  headerChristmas.show();
  courierSnowdrift.show();
}
