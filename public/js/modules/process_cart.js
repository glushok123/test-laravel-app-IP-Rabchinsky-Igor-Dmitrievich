
$.fn.processAddCart = function (view, requestData) {
    let attributes = {
        buttonAddCart       : '[add-in-cart]',
        buttonRemoveIsCart  : '[remove-is-cart]',
        buttonClearIsCart   : '[clear-is-cart]',
    },
    process = {
        requestAddInCart: function (requestData) {
            const link = '/cart/';

            $.post(link, requestData, callBackActions.successResponseAdd).fail(callBackActions.errorResponse);
        },
        requestRemoveIsCart: function (requestData) {
            const link = '/remove/';

            $.post(link, requestData, callBackActions.successResponseRemove).fail(callBackActions.errorResponse);
        },
        requestClearIsCart: function (requestData) {
            const link = '/clear/';

            $.post(link, requestData, callBackActions.successResponseClear).fail(callBackActions.errorResponse);
        },
    },
    callBackActions = {
        add: function () {
            parent = $(this).parent().find('form')
            process.requestAddInCart(parent.serialize());
        },
        remove: function () {
            itemId = $(this).data('cart-id')
            requestData = {
                id : itemId
            }

            process.requestRemoveIsCart(requestData);
            $(this).parent().parent().remove();
        },
        clear: function () {
            requestData= {};
            process.requestClearIsCart(requestData);
        },
        successResponseAdd: function(data) {
            $('[text-cart]').text(data.textCart)
            toastr.success('Добавлен в корзину !');
        },
        successResponseRemove: function(data) {
            $('[text-cart]').text(data.textCart)
            toastr.success('Удален из корзины !');
        },
        successResponseClear: function(data) {
            $('[text-cart]').text(data.textCart)
            toastr.success('Корзина очищена !');
            location.reload()
        },
        errorResponse: function(e) {
            toastr.error('Произошла ошибка:  ' + e.statusText + ' !');
        }
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', attributes.buttonAddCart, callBackActions.add)
               .on('click', attributes.buttonRemoveIsCart, callBackActions.remove)
               .on('click', attributes.buttonClearIsCart, callBackActions.clear);
}

$(document).processAddCart(this)

console.log("process_cart loaded");