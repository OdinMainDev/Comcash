import $ from "jquery";
import select2 from 'select2';
import 'slick-carousel'
window.jQuery = window.$ = $; 
select2($);

$(document).ready(function () {
    // $('.select2boxindex').select2({
    //     placeholder: "Выберите город",
    //     maximumSelectionLength: 2,
    //     language: window.language ,
    //     templateResult: formatState,
    //     templateSelection: formatState
    // });
});

function formatState(state) {
    if (!state.id) {
      return state.text;
    }
    var baseUrl = "/img/icons/locales";
    var $state = $(
      '<span><img src="' + state.element.dataset.image + '" class="img-flag" /> ' + state.text + '</span>'
    );
    return $state;
};

const tabButtons = document.querySelectorAll('.welcome__tabs-btn');
const tabsContent = document.querySelectorAll('.welcome__tabs-content');

window.openIndexExchangeTab = function(e, tab) {
  tabButtons.forEach(btn => {
    btn.classList.remove('active');
  });
  e.target.classList.add('active');

  tabsContent.forEach(content => {
    content.classList.remove('active');
    if (content.getAttribute('data-tab') === tab) content.classList.add('active');
  });
}

window.activateCommentsCarousel = function() {
  console.log("start");
  if(!$('.slider').length){
    return;
  }
  console.log("start2");

  $('.slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    dots: true,
    arrows: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 680,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          dots: true
        }
      }

    ]
  });
}
window.activateCommentsCarousel();