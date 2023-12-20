import $ from 'jquery';
window.jQuery = $;
import 'magnific-popup'


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
    if($('.open___signin').length){
        $('.open___signin').magnificPopup({
            type: 'inline',
        });
    }

    if($('.open___signup').length){
      $('.open___signup').magnificPopup({
          type: 'inline',
      });
  }

    var elem = document.createElement('button');
    elem.style.display = 'none';
    elem.classList.add('magnificPopUpClassId');
    elem.dataset.mfpSrc = '#auth-popup'
    document.body.appendChild(elem)
    $('.magnificPopUpClassId').magnificPopup({
        type: 'inline',
    });

    if(window.openAuthModal){
        window.setForm('signin');
        $('.magnificPopUpClassId')[0].click();
    }
})();