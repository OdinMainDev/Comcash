import Swiper from 'swiper';
import 'swiper/css';

$(document).ready(function () {
  var swiper = new Swiper(".welcome__exchange-mobile-side-list", {
    slidesPerView: 1,
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

});