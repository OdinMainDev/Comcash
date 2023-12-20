import $ from 'jquery'

const button = $('.header__burger');
const navMobile = $('.header__nav-mobile');
const header = $('.header');

button.on('click', function() {
  button.toggleClass('active');
  navMobile.toggleClass('active');
  header.toggleClass('active');
})