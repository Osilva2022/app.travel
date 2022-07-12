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

    function SetMenuOptionActive() {
        var destino = getUrlParameter('destination');
        if (!destino) {
            destino = 'all';
        }
        $($("#" + destino + "-tab")).addClass('active');
        var offset = $("#" + destino + "-tab").offset();
        var top = offset.top;
        var left = offset.left;
        //console.log(left);
        $('.cont-menu-destination').scrollLeft(left);
    }
    SetMenuOptionActive();

    function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };

});