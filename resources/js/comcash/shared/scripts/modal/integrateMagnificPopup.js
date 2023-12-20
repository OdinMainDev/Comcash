// eslint-disable-next-line @typescript-eslint/no-explicit-any
import $ from 'jquery';
import 'magnific-popup';
export const closeForm = () => {
  $.magnificPopup.close();
}

export const integrateMagnificPopup = () => {
  $('.header__btn').magnificPopup({
    type: 'inline',
    callbacks: {
      elementParse: function (item) {
        console.log('Start of popup initialization', item);
      }
    },
  });
}

