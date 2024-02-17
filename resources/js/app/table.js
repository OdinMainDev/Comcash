import $ from 'jquery';

$(document).on('click', '.admin-exchange-table__arrow', function() {
    // Ваш код здесь
    $(this).prev().find('.admin-exchange-table__row ').toggleClass('hidden-row');
    $(this).toggleClass('rotate')
});