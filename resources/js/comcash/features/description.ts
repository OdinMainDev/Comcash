import $ from 'jquery';

$(document).ready(function() {
    $("#descriptionToggleButton").on("click", function() {
        $('#descriptionFullBlock').slideToggle();
    });
});
