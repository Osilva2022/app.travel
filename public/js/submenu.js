$(document).ready(function() {

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

    function SetMenuOptionActive() {
        var destino = getUrlParameter('destination');
        if (!destino) {
            destino = 'all';
        }
        $($("#" + destino + "-tab")).addClass('active');
        var offset = $("#" + destino + "-tab").offset();
        var left = offset.left;
        //console.log(left);
        $('.cont-menu-destination').scrollLeft(left);
    }
    SetMenuOptionActive();
});