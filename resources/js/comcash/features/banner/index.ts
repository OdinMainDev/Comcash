import $ from 'jquery';

$(document).ready(function() {
    const $modal = $('#main-banner');
    const $closeBtn = $('#close-btn');

    // Show the modal with animation
    setTimeout(() => {
        $modal.addClass('show').css('display', 'flex');
    }, 100);

    $closeBtn.on('click', function() {
        $modal.addClass('hide');
        setTimeout(() => {
            $modal.removeClass('show hide').css('display', 'none');
        }, 500);
    });

    $(window).on('click', function(event) {
        if ($(event.target).is($modal)) {
            $modal.addClass('hide');
            setTimeout(() => {
                $modal.removeClass('show hide').css('display', 'none');
            }, 500);
        }
    });
});
