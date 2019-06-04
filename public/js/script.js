var dropper = document.querySelector('.drop');

dropper.addEventListener('dragenter', function() {
    dropper.style.borderStyle = 'dashed';
})

dropper.addEventListener('dragleave', function() {
    dropper.style.borderStyle = 'solid';
})

dropper.addEventListener('dragend', function() {
    alert('work');
})