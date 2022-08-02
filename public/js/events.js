$(document).ready(function() {
    var paginate = 1;
    loadMoreData(paginate);

    $('#load-more').click(function() {
        var page = $(this).data('paginate');
        loadMoreData(page);
        $(this).data('paginate', page + 1);
    });
    // run function when user click load more button
    function loadMoreData(paginate) {
        $.ajax({
                url: '?page=' + paginate,
                type: 'get',
                datatype: 'html',
                beforeSend: function() {
                    $('#load-more').text('Loading...');
                }
            })
            .done(function(data) {
                if (data.length == 0) {
                    $('.invisible').removeClass('invisible');
                    $('#load-more').hide();
                    return;
                } else {
                    $('#load-more').text('Load more...');
                    $('#post').append(data);
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('Something went wrong.');
            });
    }
});