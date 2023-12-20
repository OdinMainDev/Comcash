import $ from 'jquery';

$(document).ready(() => {
    $('.accordion__button').on('click', function() {
        $(this).toggleClass('active');
        const $panel: JQuery<HTMLElement> = $(this).next();

        if ($panel.length) {
            const panelElement = $panel.get(0);
            if (panelElement) { // Check if panelElement is not undefined
                if ($panel.css('maxHeight') !== '0px') {
                    $panel.css('maxHeight', '');
                } else {
                    $panel.css('maxHeight', `${panelElement.scrollHeight}px`);
                }
            }
        }
    });
});
