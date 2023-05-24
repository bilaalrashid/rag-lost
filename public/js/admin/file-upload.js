const inputs = document.querySelectorAll('input[type="file"]');
inputs.forEach(input => {
  input.onchange = () => {  
    const maxSize = input.getAttribute('data-max-size');
    if (maxSize != undefined && input.files[0].size > maxSize) {
       alert('Selected file is too big!');
       input.value = '';
    };
  };
});
