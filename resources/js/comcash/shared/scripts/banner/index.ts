import $ from 'jquery';

$(document).ready(function () {
  const banner =  $('.welcome__banner');
  const bannerArrowLeft = banner.find('.welcome__banner-arrow_left');
  const bannerArrowRight = banner.find('.welcome__banner-arrow_right');
  const welcomeForm = $('.welcome__form');
  const welcomeSecurity = $('.welcome__security');

  bannerArrowLeft.on('click', function() {
    banner.addClass('hide');
    welcomeForm.addClass('center')
    welcomeSecurity.addClass('center')

  });

  bannerArrowRight.on('click', function() {
    banner.removeClass('hide');
    welcomeForm.removeClass('center')
    welcomeSecurity.removeClass('center')

  });
});