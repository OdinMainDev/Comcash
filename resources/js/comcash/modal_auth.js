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

$('body').on('click', ".open___signin", function () {
    window.setForm("signin");
});

window.setForm = function(type) {
    var templates = [];
    if(document.querySelector('.templates')){
        templates = Array.from(document.querySelector('.templates').children);
    }

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
    if($(".open___signin").length){
        $('.open___signin').magnificPopup({
            type: 'inline',
        });
    }
    var elem = document.createElement("button");
    elem.style.display = "none";
    elem.classList.add("magnificPopUpClassId");
    elem.dataset.mfpSrc = "#auth-popup"
    document.body.appendChild(elem)
    $('.magnificPopUpClassId').magnificPopup({
        type: 'inline',
    });

    if(window.openAuthModal){
        window.setForm("signin");
        $('.magnificPopUpClassId')[0].click();
    }
})();