import $ from "jquery";
import axios from "axios";

// burger logic
const button = document.querySelector('.header__burger');
const menu = document.querySelector('.header__links');
const navMobile = document.querySelector('.header__nav-mobile');
const header = document.querySelector('.header');

if(button){
    button.addEventListener('click', () => {
        button.classList.toggle('active');
        navMobile.classList.toggle('active');
        header.classList.toggle('active');
    });
}
// -----------


// select logic
(function() {
    const selectArray = document.querySelectorAll(".select");

    selectArray.forEach((select) => {
    const optionsList = select.querySelectorAll(".select__container .select__option");
    const selected = select.querySelector('.select__current');

    select.addEventListener("click", (e) => {
        if (select.classList.contains("active")) {
          select.classList.remove("active");
        } else {
          select.classList.add("active");

        // close on outsideclick
          document.addEventListener('click', function cb(e) {
              if (e.target.contains(select)) {
                select.classList.remove("active");
                document.removeEventListener('click', cb);
              }
          });
        }
    });

    optionsList.forEach((opt) => {
        // set default option
        if (opt.querySelector("input").checked) {
            opt.classList.add('selected');
            selected.innerHTML = opt.querySelector("label").innerHTML;
        }

        // set option on click
        opt.addEventListener("click", (e) => {
            e.stopPropagation();
            e.preventDefault();
            
            var inputel = opt.querySelector("input");
            if(inputel.name == "locale"){
                var pathname = window.location.pathname;
                var lang = pathname.split("/")[1];
                if(lang == inputel.value){
                    return;
                }
              
                window.location.replace("/" + inputel.value + pathname.slice(3));
            }
        });
    });
    });
})();
// -----------


// tabs logic

// window.openTab = function(e, tab) {
//     const tabButtons = document.querySelectorAll('.welcome__tabs-btn');
//     const tabsContent = document.querySelectorAll('.welcome__tabs-content');

//     tabButtons.forEach(btn => {
//         btn.classList.remove('active');
//     });
//     e.target.classList.add('active');

//     tabsContent.forEach(content => {
//         content.classList.remove('active');
//         if (content.getAttribute('data-tab') === tab) content.classList.add('active');
//     });
// }
// -----------


// accordion logic
(function() {
    let acc = document.querySelectorAll(".accordion__button");
    for (var i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function(){
            this.classList.toggle("active");
            let panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            }
            else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
})();
// -----------


(function() {
    var elem = $("#needRefreshPageId");
    if(elem.length){
        setTimeout(() => {
            window.location.reload();
        }, 10000);
    }
})();

(function() {
    var elem = $("#needCheckStatusExchange");
    if(elem.length){
        setTimeout(() => {
            checkId();
        }, 5000);
    }
})();

function checkId(){
    axios.get("/api/get/exchange/status/"+window.exchangeHash).then(e => {
        if(e.data.data.status > window.exchangeStatus){
            window.location.reload();
        }else{
            setTimeout(() => {
                checkId();
            }, 5000);
        }
    }).catch(error => {
       
    })
}

function formatState(state) {
  if (!state.id) {
    return state.text;
  }
  var baseUrl = "//comcash/img/icons/locales";
  var $state = $(
    '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
  );
  return $state;
};
// -----------
