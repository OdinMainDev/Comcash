import $ from 'jquery';
import './modal.scss';

export function openModal(modalSelector: string) {
  $(modalSelector).css('display', 'block');
  $('body').addClass('modal-open');
}

export function setForm(type: string) {
  const templates = $('.templates').children();
  templates.each(function() {
    const item = $(this);
    item.removeClass('active');

    if (item.attr('id') === type) {
      item.addClass('active');
    }
  });
}

export function closeModal(modalSelector: string) {
  $(modalSelector).css('display', 'none');
  $('body').removeClass('modal-open');
}

export function initializeModalCloseOutsideHandler(modalSelector: string) {
  $(window).on('click', function(event) {
    if ($(event.target).is(modalSelector)) {
      $(modalSelector).css('display', 'none');
      $('body').removeClass('modal-open');
    }
  });
}

$('body').on('click', '.open___signin', function () {
  setForm('signin');
});

$('body').on('click', '.open___signup', function () {
  setForm('signup');
});
