import $ from "jquery";
import select2 from 'select2';
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