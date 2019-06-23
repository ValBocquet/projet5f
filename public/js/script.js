let form = document.querySelector('.form');

form.addEventListener('drop', function (e) {
    e.preventDefault();
    form.style.borderStyle = 'solid';
    form_NameFile.files = e.dataTransfer.files;
});

form.addEventListener('dragover', function (e) {
    e.preventDefault();
});


form.addEventListener('dragenter', function () {
    form.style.borderStyle = 'dashed';
});
form.addEventListener('dragleave', function () {
    form.style.borderStyle = 'solid';
});

