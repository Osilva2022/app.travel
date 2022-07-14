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

    $(".filtrar-categoria").click(function(e) {
        var categoria = $(this).data('categoria');
        console.log(categoria);
        if (categoria == "x") {
            $(".cont-categoria").delay(250).fadeIn();
        } else {
            $(".cont-categoria").delay(50).fadeOut();
            $(".cat-" + categoria).delay(200).fadeIn();
        }
    });

});