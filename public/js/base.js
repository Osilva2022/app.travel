$(document).ready(function () {
    /* ésto comprueba la localStorage si ya tiene la variable guardada */
    function compruebaAceptaCookies() {
        if (localStorage.aceptaCookies != "true") {
            cajacookies.style.display = "block";
        }
    }

    /* aquí guardamos la variable de que se ha
    aceptado el uso de cookies así no mostraremos
    el mensaje de nuevo */
    function aceptarCookies() {
        localStorage.aceptaCookies = "true";
        cajacookies.style.display = "none";
    }

    /* ésto se ejecuta cuando la web está cargada */
    // $(document).ready(function () {
    //     // compruebaAceptaCookies();
    // });
    $(function () {
        $(window).on("scroll", function () {
            if ($(window).scrollTop() > 200) {
                $("#menu-header").addClass("menu-active");
                compruebaAceptaCookies();
            } else {
                $("#menu-header").removeClass("menu-active");
            }
        });

        $("#btn-menu").click(function (e) {
            $("#menu-header").addClass("menu-active");
        });
    });

    $(".filtrar-categoria").click(function (e) {
        var categoria = $(this).data("categoria");
        console.log(categoria);
        if (categoria == "x") {
            $(".cont-categoria").delay(250).fadeIn();
        } else {
            $(".cont-categoria").delay(50).fadeOut();
            $(".cat-" + categoria)
                .delay(200)
                .fadeIn();
        }
    });
});
