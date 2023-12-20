import $ from 'jquery';


$(document).ready(function () {
    const kycInput = $('.kyc__input > input');

    kycInput.on('change', function(): void {
        const filePath = $(this).val()as string;;
        if (filePath) {
            const fileName = filePath.split('\\').pop();
            if (fileName) {
                $(this).siblings('.button').text(fileName);
            }
        } else {
            const placeholder = $(this).attr('placeholder')
            $(this).siblings('.button').text(placeholder || '');
        }
    });
})