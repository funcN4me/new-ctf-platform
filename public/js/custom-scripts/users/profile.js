$(document).ready(function() {
    $.ajax({
        url: '/users/1/favourite-categories',
        type: 'GET',

        success: function (response) {
            let categories = Object.values(response);
            console.log(categories);
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = {
                labels: categories.map(category => category.name),
                datasets: [
                    {
                        data: categories.map(category => category.tasks_count),
                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
                    }
                ]
            }
            var pieOptions = {
                legend: {
                    display: true
                }
            }
            // Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            // eslint-disable-next-line no-unused-vars
            var pieChart = new Chart(pieChartCanvas, {
                type: 'doughnut',
                data: pieData,
                options: pieOptions
            })
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
