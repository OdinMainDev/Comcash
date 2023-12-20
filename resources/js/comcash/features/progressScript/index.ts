import $ from 'jquery';

const copyButton = $('.progress__copy');

copyButton.on('click', function() {
  const siblingValue = $(this).prev('.progress__box-text').find('.value').text();
  $(this).addClass('clicked');
  const button = $(this);
  setTimeout(function() {
      button.removeClass('clicked');
  }, 300);
  copyContent(siblingValue)
})

const copyContent = async (text: string) => {
  try {
    await navigator.clipboard.writeText(text);
  } catch (err) {
  }
}