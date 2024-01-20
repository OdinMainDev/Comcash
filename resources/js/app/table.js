import $ from 'jquery';

$(document).on('click', '.admin-exchange-table', function() {
    // Ваш код здесь
    $(this).find('.admin-exchange-table__row ').toggleClass('hidden-row');
    $(this).toggleClass('rotate')
});