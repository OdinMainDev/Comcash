import axios from "axios";
import * as Toastr from 'toastr';
import $ from 'jquery';

(() => {

    const forms = document.querySelectorAll('form');

    if(forms.length == 0) return false;
    forms.forEach(element => {
        element.addEventListener('submit', e => {
            if(element.dataset.notused == "true"){
                return;
            }
            e.preventDefault();
            const route = element.action;
            const redirect = element.dataset.redirect;
            const formData = new FormData(element);
            const submit = element.querySelectorAll('[type="submit"]');
            const prevInner = submit[0].innerHTML;
            $(".inputErrorLabelClass").remove();
            submit.forEach(element => {
                element.disabled = true;
                element.innerHTML = `<div class="spinner-border spinner-border-sm m-auto" role="status"><span class="visually-hidden"></span></div>`; 
            });
            var elems = document.querySelectorAll(".is-invalid");
            for(var i = 0; i < elems.length; i++){
                elems[i].classList.remove("is-invalid");
                if(document.getElementById(elems[i].dataset.name + "Error")){
                    document.getElementById(elems[i].dataset.name + "Error").innerHTML = "";
                }
            }
            $(".errorRepeater").children().html(``);
            $(".has-danger").removeClass("has-danger")
            axios.post(route, formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                  },
            }).then(e => {
                Toastr.success(e.data.title, e.data.message)
                submit.forEach(element => {
                    element.innerHTML = prevInner
                    element.disabled = false
                });
                if(e.data.refresh){
                    window.location.reload();
                }
                if(redirect != "false" && redirect != undefined){
                    setTimeout(() => {
                        window.location.href = redirect;
                    }, 2500)
                }
            }).catch(error => {
                console.log(error);
                const response = error.response.data
                submit.forEach(element => {
                    element.innerHTML = prevInner
                    element.disabled = false
                });
                if(typeof(response.errors) === "object"){
                    for (const input in response.errors) {
                        for(const index in response.errors[input]){
                            var elem = $("[name='"+input+"']");
                            if(elem.length){
                                elem.parent().addClass("has-danger")
                                elem.parent().addClass("form-group")
                                elem.parent().append(`<label class="error mt-2 text-danger inputErrorLabelClass" for="name">${response.errors[input][index]}</label>`)
                            }
                            Toastr.error(response.errors[input][index])
                        }
                    }
                }else{
                    Toastr.error("undefined error...")
                }
            })
        })
    });

})()