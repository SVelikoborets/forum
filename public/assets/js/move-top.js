    window.onscroll = function () {
    scrollFunction()
};

    function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("movetop").style.display = "block";
} else {
    document.getElementById("movetop").style.display = "none";
}
}

    function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
