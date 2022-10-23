$(document).ready(function() {
    $('#changeUserStatus').on('click', function() {
        let userId = $(this).data('id');
        let isActive = $(this).data('is-active');

        $.ajax({
            url: `/users/${userId}/change-status`,
            type: "GET",
            data: {
                "user": userId
            },
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
            });
            if (isActive == 1) {
                alert(123);
            }
            else {
                $(this).removeClass('btn-success');
                $(this).addClass('btn-danger');
            }
        })
    });
});
