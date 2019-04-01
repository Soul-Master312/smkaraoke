/* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
$('body').on('click', '#sm-open-nav', function () {
    document.getElementById("mySidenav").style.width = "50%";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
});

/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
$('body').on('click', '.sm-close-nav', function () {
    document.getElementById("mySidenav").style.width = "0";
    document.body.style.backgroundColor = "white";
});