$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.header-cart-item').on('click', function () {
        var data_id = $(this).attr('data-id');
        var nameProduct = $(this).attr('name-product')
        $.post('/removeFromCart', {id: data_id})
        .done(function (response) {
            if(response.status == 200) {
                swal(nameProduct, "is removed from cart !", "success").then(function () {
                    location.reload();
                });
            }
        });
    });

    $('.block2-overlay > .block2-btn-addcart').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            var data_id = $(this).attr('data-id');
            var store_id = $(this).attr('store-id');
            $.post('/addToCart', {id: data_id, qty: 1, store_id: store_id})
            .done(function (response) {
                if(response.status == 200) {
                    swal(nameProduct, "is added to cart !", "success").then(function () {
                        location.reload();
                    });
                }
            });
        });
    });

    $('.btn-addcart-product-detail').each(function(){
        $(this).on('click', function(){
            var nameProduct = $(this).attr('data-name');
            var data_id = $(this).attr('data-id');
            var store_id = $(this).attr('store-id');
            $.post('/addToCart', {id: data_id, qty: 1, store_id: store_id})
            .done(function (response) {
                if(response.status == 200) {
                    swal(nameProduct, "is added to cart !", "success").then(function () {
                        location.reload();
                    });
                }
            });
        });
    });

    $('.btn-addcart').each(function(){
        var nameProduct = $(this).parent().parent().find('.s-name').html();
        $(this).on('click', function(){
            var data_id = $(this).attr('data-id');
            var price = $(this).attr('price');
            var store_id = $(this).attr('store-id');
            $.post('/addToCart', {id: data_id, qty: 1, price: price, store_id: store_id})
            .done(function (response) {
                if(response.status == 200) {
                    swal(nameProduct, "is added to cart !", "success").then(function () {
                        location.reload();
                    });
                }
            });
        });
    });

    $('.block2-btn-addwishlist').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            var data_id = $(this).attr('data-id');
            $.post('/addToCart', {id: data_id, qty: 1})
            .done(function (response) {
                if(response.status == 200) {
                    swal(nameProduct, "is added to cart !", "success").then(function () {
                        location.reload();
                    });
                }
            });
        });
    });

    var filterBar = document.getElementById('filter-bar');

    if(filterBar != null) {
        noUiSlider.create(filterBar, {
            start: [ 50, 200 ],
            connect: true,
            range: {
                'min': 50,
                'max': 200
            }
        });

        var skipValues = [
        document.getElementById('value-lower'),
        document.getElementById('value-upper')
        ];

        filterBar.noUiSlider.on('update', function( values, handle ) {
            skipValues[handle].innerHTML = Math.round(values[handle]) ;
        });
    }

    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect2')
    });
});
