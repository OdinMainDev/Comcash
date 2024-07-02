import $ from 'jquery';
import Cookies from 'js-cookie'; // Подключите библиотеку js-cookie для работы с cookies

$(document).ready(function() {
    const $modal = $('#main-banner');
    const $closeBtn = $('#close-btn');

    const hasSeenModal = Cookies.get('hasSeenModal');

    if (!hasSeenModal) {
        setTimeout(() => {
            $modal.addClass('show').css('display', 'flex');
        }, 100);
    }

    $closeBtn.on('click', function() {
        $modal.addClass('hide');
        Cookies.set('hasSeenModal', 'true', { expires: 365 });
        setTimeout(() => {
            $modal.removeClass('show hide').css('display', 'none');
        }, 500);
    });
});
