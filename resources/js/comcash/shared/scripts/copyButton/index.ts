import $ from "jquery";

const copyButton = $('.header-info__contact.copy');

copyButton.on('click', function() {
    const siblingValue = $(this).find('.header-info__contact-label').text();
    $(this).addClass('clicked');
    const button = $(this);
    setTimeout(function() {
        button.removeClass('clicked');
    }, 300);
    copyContent(siblingValue.trim())
});

const copyContent = async (text: string) => {
    try {
      await navigator.clipboard.writeText(text);
    } catch (err) {
    }
  }