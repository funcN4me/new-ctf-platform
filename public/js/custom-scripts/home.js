$(document).ready(function () {
    $.ajax({
        url: '/home/get-favourite-categories',
        type: 'GET',

        success: function (response) {
            makePieChart(response);
        }
    });

    $.ajax({
        url: '/home/get-tasks-by-months',
        type: 'GET',

        success: function (response) {
            makeLineChart(response);
        }
    })
});
