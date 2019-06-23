$(document).on('dragenter', '.uploadsForm', function() {
    $(this).css('border', '3px dashed red');
    return false;
});

$(document).on('dragover', '.uploadsForm', function(e){
    e.preventDefault();
    e.stopPropagation();
    $(this).css('outlet', '3px dashed red');
    return false;
});

$(document).on('dragleave', '.uploadsForm', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).css('border', '3px dashed #BBBBBB');
    return false;
});

$(document).on('drop', '.uploadsForm', function(e) {
    if(e.originalEvent.dataTransfer){
        if(e.originalEvent.dataTransfer.files.length) {
            // Stop the propagation of the event
            e.preventDefault();
            e.stopPropagation();
            $(this).css('border', '3px dashed green')
            // Main function to upload
            document.querySelector('#form_NameFile').classList.add('coucou')
        }
    }
    else {
        $(this).css('border', '3px dashed #BBBBBB');
    }
    return false;
});

