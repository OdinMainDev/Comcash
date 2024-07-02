import $ from 'jquery';
import Cookies from 'js-cookie';

$(document).ready(function() {
    const $modal = $('#main-banner');
    const $closeBtn = $('#close-btn');

    const hasSeenModal = Cookies.get('hasSeenModal2');

    if (!hasSeenModal) {
        setTimeout(() => {
            $modal.addClass('show').css('display', 'flex');
        }, 100);
    }

    $closeBtn.on('click', function() {
        $modal.addClass('hide');
        Cookies.set('hasSeenModal2', 'true', { expires: 1 });
        setTimeout(() => {
            $modal.removeClass('show hide').css('display', 'none');
        }, 500);
    });
});
