$(document).ready(function() {

    $('.directory-carousel').owlCarousel({
        loop: false,
        margin: 25,
        center: false,
        nav: false,
        dots: false,
        items: 2
    });

    /*  $(".btn-info-dir").click(function(e) {
         e.preventDefault();
         var id = $(this).data('id');
         var status = $(this).data('status');
         var gallery = $(this).data('gallery');
         console.log(id);
         if (status == 0) {
             $(this).html('<i class="bi bi-dash-lg"></i> Show Less');
             $(this).data('status', '1');
             $("#cont-info-" + id).show(500);
             $.ajax({
                 type: "get",
                 url: "url",
                 data: gallery,
                 success: function(data) {
                     $("#dc-" + id).html(data);
                 }
             });
         } else {
             $(this).html('<i class="bi bi-plus-lg"></i> Show More');
             $(this).data('status', '0');
             $("#cont-info-" + id).hide(500);
         }
     }); */

    /* $(".cont-info").delay(1500).hide(); */
    /* $(".dc").hide(); */
});