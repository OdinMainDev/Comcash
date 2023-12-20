import $ from 'jquery';

// eslint-disable-next-line @typescript-eslint/no-explicit-any
export const errorValidator = (error: any) => {
  const exchangeForm = $('.exchange__form');
  const response = error.response;
  if(response) {
    const errors = response.data.errors;
    const layouts = Object.keys(errors);
    layouts.forEach(item => {
      console.log(errors[item][0])
      exchangeForm.find(`#exchange-${item}`).after(`<div class="error">${errors[item][0]}</div>`)
      setTimeout(function() {
        exchangeForm.find(`#exchange-${item} + .error`).remove();
    }, 1000); //
    })
  }
}