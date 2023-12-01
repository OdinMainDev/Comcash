import axios from "axios";
import * as Toastr from 'toastr';
import $ from 'jquery';
import FingerprintJS from  "@fingerprintjs/fingerprintjs";

(() => {

    const forms = document.querySelectorAll('form');

    if(forms.length == 0) return false;
    forms.forEach(element => {
        element.addEventListener('submit', e => {
            e.preventDefault();
            const route = element.action;
            const redirect = element.dataset.redirect;
            const formData = new FormData(element);
            const submit = element.querySelectorAll('[type="submit"]');
            const prevInner = submit[0].innerHTML;
            submit.forEach(el => {
                el.disabled = true;
                el.innerHTML = `<div class="btn-loader"><div class="loader-bar"></div></div>${prevInner}`; 
            });
            var elems = element.querySelectorAll(".input--error");
            for(var i = 0; i < elems.length; i++){
                elems[i].classList.remove("input--error");
            }
            elems = element.querySelectorAll("p.error");
            for(var i = 0; i < elems.length; i++){
                elems[i].remove();
            }
            const fpPromise = FingerprintJS.load()
            fpPromise
            .then(fp => fp.get())
            .then(result => {
                formData.append("fid", result.visitorId)
                axios.post(route, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                }).then(e => {
                    if(!e.data.success){
                        Toastr.error(e.data.title, e.data.message)
                    }else{
                        Toastr.success(e.data.title, e.data.message)
                    }
                    submit.forEach(el => {
                        el.innerHTML = prevInner
                        el.disabled = false
                    });
                    if(e.data.data?.refresh){
                        setTimeout(() => {
                            window.location.reload();
                        }, 100)
                        return;
                    }
                    if(e.data.data?.redirect){
                        setTimeout(() => {
                            window.location.href = e.data.data.redirect;
                        }, 100)
                        return;
                    }
                    if(e.data.data?.open_modal){
                        if(e.data.data?.open_modal == "verification-sent"){
                            $(".mfp-close").remove();
                        }

                        if(e.data.data?.open_modal == "recover-password"){
                            document.getElementById("recover-password").querySelector("[name='hash']").value = e.data.data.hash;
                        }
                        window.setForm(e.data.data?.open_modal);
                        return;
                    }
                    if(redirect != "false" && redirect != undefined){
                        setTimeout(() => {
                            window.location.href = redirect;
                        }, 100)
                        return;
                    }
                }).catch(error => {
                    submit.forEach(el => {
                        el.innerHTML = prevInner
                        el.disabled = false
                    });
                    if(!error.response){
                        Toastr.error("undefined error...")
                        return;
                    }
                    const response = error.response.data
                    var toastrErrors = [];
                    if(typeof(response.errors) === "object"){
                        for (const input in response.errors) {
                            for(const index in response.errors[input]){
                                var elem = element.querySelectorAll("[name='"+input+"']");
                                if(!toastrErrors.includes(response.errors[input][index])){
                                    Toastr.error(response.errors[input][index]);
                                    toastrErrors.push(response.errors[input][index]);
                                }
                                if(elem.length){
                                    elem = elem[0]
                                    $(elem).addClass("input--error");
                                    if(input == "password" || input == "oldpassword" || input == "repassword"){
                                        $(elem).parent().after(`<p class="error">${response.errors[input][index]}</p>`);
                                        continue;
                                    }
                                    $(elem).after(`<p class="error">${response.errors[input][index]}</p>`);
                                }
                                
                            }
                        }
                    }else{
                        Toastr.error("undefined error...")
                    }
                })
            })
        })
    });

})()