import $ from "jquery";
import select2 from 'select2';
select2($);

$(document).ready(function () {
    $('.select2boxindex').select2({
        placeholder: "Выберите город",
        maximumSelectionLength: 2,
        language: window.language ,
        templateResult: formatState,
        templateSelection: formatState
    });
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