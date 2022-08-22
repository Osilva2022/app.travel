$(document).ready(function() {

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

});