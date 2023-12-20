// eslint-disable-next-line @typescript-eslint/no-explicit-any
export const errorValidator = (error: any) => {
  const response = error.response;
  if(response) {
    const errors = response.data.errors;
    const layouts = Object.keys(errors);
    layouts.forEach(item => {
      console.log(`#main-${item}`)
      $(`#main-${item}`).after(`<div class="error">${errors[item][0]}</div>`)
      setTimeout(function() {
        $(`#main-${item} + .error`).remove();
    }, 1000); //
    })
  }
}