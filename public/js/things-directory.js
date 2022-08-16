$(document).ready(function() {

    $('.directory-carousel').owlCarousel({
        loop: true,
        margin: 25,
        center: false,
        nav: true,
        dots: false,
        items: 1
    });

    $(".btn-info-dir").click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var status = $(this).data('status');
        console.log(id);
        if (status == 0) {
            $(this).html('<i class="bi bi-dash-lg"></i> Show Less');
            $(this).data('status', '1');
        } else {
            $(this).html('<i class="bi bi-plus-lg"></i> Show More');
            $(this).data('status', '0');
        }
    });

    /* $(".cont-info").delay(1500).hide(); */
    /* $(".dc").hide(); */
});