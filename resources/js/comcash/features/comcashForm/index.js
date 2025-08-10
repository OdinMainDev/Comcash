import axios from 'axios';
import * as Toastr from 'toastr';
import $ from 'jquery';
import FingerprintJS from  '@fingerprintjs/fingerprintjs';
import { confirmCardStatus } from '../confirmCardStatus/confirmCardStatus';
import { setForm } from '@/shared/scripts/modal';

(() => {

    const forms = document.querySelectorAll('form');

    function showLoader() {
        $(".content-loader").hide();
        $(".glitch").show();
    }
    function hideLoader() {
        $(".content-loader").show();
        $(".glitch").hide();
    }


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
                el.innerHTML = `<div class="loader flex h-full items-center justify-center">
                                 <div data-glitch="Loading..." class="glitch">Loading...</div>
                                </div>`; 
            });
            showLoader();
            let elems = element.querySelectorAll('.input--error');
            for(let i = 0; i < elems.length; i++){
                elems[i].classList.remove('input--error');
            }
            elems = element.querySelectorAll('p.kyc__error');
            for(let j = 0; j < elems.length; j++){
                elems[j].remove();
            }
            
            if(route.includes("exchange/redirect")){
                window.updateYMForm("fillShortForm");
            }
            if(route.includes("exchange/create")){
                window.updateYMForm("fillFullForm");
            }
            const fpPromise = FingerprintJS.load()
            .then(fp => fp.get())
            .then(result => {
                formData.append('fid', result.visitorId)
                axios.post(route, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                }).then(e => {
                    if(route.includes('/exchange/kyc')){
                        confirmCardStatus('ru', window.kycId);
                        // return;
                    }
                    if(!e.data.success){
                        Toastr.error(e.data.title, e.data.message)
                    }else{
                        Toastr.success(e.data.title, e.data.message)
                    }
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
                    if (e.data.data?.open_modal_cashexchange) {

                        $('.default-form').addClass('hidden');
                        $('.exchange__cash-modal').removeClass('hide');
                        return;
                    }
                    if(e.data.data?.open_modal){
                        if(e.data.data?.open_modal == 'verification-sent'){
                            $('.mfp-close').remove();
                        }

                        if(e.data.data?.open_modal == 'recover-password'){
                            document.getElementById('recover-password').querySelector("[name='hash']").value = e.data.data.hash;
                        }
                        setForm(e.data.data?.open_modal);
                        return;
                    }
                    if(redirect != 'false' && redirect != undefined){
                        setTimeout(() => {
                            window.location.href = redirect;
                        }, 100)
                        return;
                    }
                }).catch(error => {
                    if(!error.response){
                        Toastr.error('undefined error...')
                        return;
                    }
                    const response = error.response.data
                    let toastrErrors = [];
                    if(typeof(response.errors) === 'object'){
                        if(response?.errors['kyc_required']?.length == 1){
                            console.log('OPEN MODAL', $('#open-modal-btn-hidden'));
                            setForm('kyc-verification');
                            $('.magnificPopUpClassId')[0].click();
                            setForm('kyc-verification');
                            window.kycId = response.errors['kyc_required'][0];
                            document.getElementById('kyc_id').value = window.kycId;
                            return;
                        } 
                        for (const input in response.errors) {
                            for(const index in response.errors[input]){
                                let elem = element.querySelectorAll("[name='"+input+"']");
                                if(!toastrErrors.includes(response.errors[input][index])){
                                    Toastr.error(response.errors[input][index]);
                                    toastrErrors.push(response.errors[input][index]);
                                }
                                if(elem.length){
                                    elem = elem[0]
                                    $(elem).addClass('input--error');
                                    if(input == 'password' || input == 'oldpassword' || input == 'repassword'){
                                        $(elem).parent().after(`<p class="kyc__error">${response.errors[input][index]}</p>`);
                                        continue;
                                    }
                                    $(elem).after(`<p class="kyc__error">${response.errors[input][index]}</p>`);
                                }
                                
                            }
                        }
                    }else{
                        Toastr.error('undefined error...')
                    }
                }).finally(() => {
                    submit.forEach(el => {
                        el.innerHTML = prevInner
                        el.disabled = false
                    });
                    hideLoader();
                })
            })
        })
    });

})()