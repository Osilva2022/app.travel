$(document).ready(function() {
    $(function() {
        $(window).on("scroll", function() {
            if ($(window).scrollTop() > 200) {
                $("#menu-header").addClass("menu-active");

            } else {
                $("#menu-header").removeClass("menu-active");
            }
        });

        $("#btn-menu").click(function(e) {
            $("#menu-header").addClass('menu-active');
        });
    });

});