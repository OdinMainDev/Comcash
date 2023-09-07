import $ from "jquery";
window.jQuery = $;
import magnificPopup from "magnific-popup"

$('body').on('click', ".input-password__eye", function () {
    $(this).toggleClass("input-password__eye--close");
    const input = $(this).prev();
  
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

$('.header__btn').magnificPopup({
    type: 'inline',
});

$('body').on('click', ".header__btn", function () {
    window.setForm("signin");
});
  
var templates = [];
if(document.querySelector('.templates')){
    templates = Array.from(document.querySelector('.templates').children);
}

window.setForm = function(type) {
    templates.forEach(item => {
        if (item.classList.contains('active'))
            item.classList.remove('active');
    })
  
    templates.forEach(item => {
        if (item.getAttribute('id') === type)
            item.classList.add('active');
    })
};

(function() {
    if(window.openAuthModal){
        window.setForm("signin");
        $('.header__btn')[0].click();
    }
})();