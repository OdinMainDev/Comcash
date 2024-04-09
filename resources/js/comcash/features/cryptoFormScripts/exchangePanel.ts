import $ from 'jquery';

$(document).ready(function() {
  const exchangePanelLeft = $('.exchnage-panel-left');
  const currencyFromAmount = exchangePanelLeft.find('.welcome-exchange__input');
  const select = $('.welcome-exchange__select');
  const selectedItem = select.find('.welcome-exchange__select-selected');
  const closeButton = select.find('.welcome-exchange__select-close');

  selectedItem.on('click', function(event) {
    event.stopPropagation();
    $(this).next().toggleClass('active');
    $(this).find('.welcome-exchange__arrow').toggleClass('active')
    selectedItem.next().not($(this).next()).removeClass('active');
    $('.welcome-exchange__arrow').not($(this).find('.welcome-exchange__arrow')).removeClass('active');

  });

  closeButton.on('click', function() {
    $(this).closest('.welcome-exchange__select').find('.welcome-exchange__select-list').removeClass('active');
    $(this).closest('.welcome-exchange__select').find('.welcome-exchange__arrow').removeClass('active');
  })

  selectedItem.next().on('click', function(event) {
    event.stopPropagation();
  });

  $(document).on('click', function(e) {
    selectedItem.next().removeClass('active');
    selectedItem.find('.welcome-exchange__arrow').removeClass('active');
  });
})