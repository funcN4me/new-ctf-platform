import makePieChart, {makeLineChart} from "../dashboards";

$(document).ready(function() {
    $.ajax({
        url: '/users/1/favourite-categories',
        type: 'GET',

        success: function (response) {
            makePieChart(response);
        }
    });

    $.ajax({
        url: '/users/1/total-tasks',
        type: 'GET',

        success: function (response) {
            makeLineChart(response);
        }
    });
});

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
            $('#changeUserStatus').data('is-active', 0);
            $('#changeUserStatus').removeClass('btn-danger');
            $('#changeUserStatus').addClass('btn-success');
            $('#changeUserStatus').text("Разблокировать");
        }
        else {
            $('#changeUserStatus').removeClass('btn-success');
            $('#changeUserStatus').data('is-active', 1);
            $('#changeUserStatus').addClass('btn-danger');
            $('#changeUserStatus').text("Заблокировать");
        }
    })
});

