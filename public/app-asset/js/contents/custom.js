$(document).ready(function () {
    $('.edit-store').on('click', function () {
        $(this).hide();
        $('.form-edit-store').show(1000);
    });

    $('.cancel-edit-store').on('click', function () {
        $('.form-edit-store').hide();
        $('.edit-store').show();
    });

    $('a.delete-smartphone').on('click', function () {
        var data_id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this product!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/product/' + data_id,
                    type: 'DELETE',
                    success: function(result) {
                        location.reload();
                    }
                });
            }
        })
    });
});
