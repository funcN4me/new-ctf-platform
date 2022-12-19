$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".nav-treeview .nav-link, .nav-link").each(function () {
        var location2 = window.location.protocol + '//' + window.location.host + window.location.pathname;
        var link = this.href;
        if(link == location2){
            $(this).addClass('active');
            $(this).parent().parent().parent().addClass('menu-is-opening menu-open');
        }
    });

    $('.select2').select2({
        theme: 'bootstrap4'
    });

});

function mySendAjax(url, type, data) {
    $.ajax({
        url: url,
        type: type,
        data: data,
    }).done(function (resp) {
        const swAlertError = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            padding: '2em'
        });
        swAlertError({
            type: 'success',
            title: resp.message,
            padding: '2em',
        })
        return {status: true, response: resp};
    }).fail(function (resp) {
        var message = 'Неизвестная ошибка';
        //Вывод разных типов выкинутых исключений, можно улучнить но в принципе пока так норм
        if (resp.message !== undefined)  message = resp.message
        if (resp.responseJSON.message !== undefined)  message = resp.responseJSON.message
        if (resp.responseJSON.errors !== undefined)  message = resp.responseJSON.errors[Object.keys(resp.responseJSON.errors)[0]][0]

        const swAlertError = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            padding: '2em'
        });
        swAlertError({
            type: 'error',
            title: message,
            padding: '2em',
        })
        return {status: false, response: resp};;
    });
}
