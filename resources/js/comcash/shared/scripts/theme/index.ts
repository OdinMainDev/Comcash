import $ from 'jquery';
import axios from 'axios';

$(function() {
  if ($('#needRefreshPageId').length) {
      setTimeout(() => {
          window.location.reload();
      }, 10000);
  }

  if ($('#needCheckStatusExchange').length) {
      setTimeout(() => {
          checkId();
      }, 5000);
  }
});

interface CustomWindow extends Window {
  exchangeHash: string;
  exchangeStatus: number;
}

declare let window: CustomWindow;

function checkId(): void {
    axios.get(`/api/get/exchange/status/${window.exchangeHash}`).then(response => {
      if (response.data.data.status > window.exchangeStatus) {
          window.location.reload();
      } else {
          setTimeout(() => {
              checkId();
          }, 5000);
      }
    }).catch(error => {
        console.log(error);
    });
}

// // eslint-disable-next-line @typescript-eslint/no-explicit-any
// function formatState(state: any): JQuery<HTMLElement> {
//   if (!state.id) {
//       return $(state.text);
//   }

//   const baseUrl: string = '//comcash/img/icons/locales';
//   const $state = $(
//       `<span><img src="${baseUrl}/${state.element.value.toLowerCase()}.png" class="img-flag" /> ${state.text}</span>`
//   );
//   return $state;
// }
