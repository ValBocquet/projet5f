jQuery(document).ready(function() {
    function scroll_to_top() {
        jQuery('#scroll_to_top').click(function() {
            jQuery('html,body').animate({scrollTop: 0}, 'slow');
        });
        jQuery(window).scroll(function(){
            if(jQuery(window).scrollTop()<300){
                jQuery('#scroll_to_top').fadeOut();
            } else{
                jQuery('#scroll_to_top').fadeIn();
            }
        });
    }
    scroll_to_top();


});


/*

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


*/


