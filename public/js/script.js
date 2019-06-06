var select = document.getElementsByClassName("list_upload");


for (var i = 0; i<select.length; i++) {
    (function (i) {
        select[i].addEventListener("mouseenter", function (e) {
            select[i].classList.add("active")
        })
    })(i);

    (function (i) {
        select[i].addEventListener("mouseleave", function (e) {
            select[i].classList.remove("active")
        })
    })(i);
}