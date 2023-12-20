import $ from 'jquery';

$('.input-password__eye').click(function () {
  $(this).toggleClass('input-password__eye--close');
  const input = $(this).prev();

  if (input.attr('type') == 'password') {
    input.attr('type', 'text');
  } else {
    input.attr('type', 'password');
  }
});