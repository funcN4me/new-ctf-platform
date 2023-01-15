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

function makePieChart(response) {
    let categories = Object.values(response);


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

    var pieChart = new Chart(pieChartCanvas, {
        type: 'doughnut',
        data: pieData,
        options: pieOptions
    });
}

function makeLineChart(response) {
    let tasksCount = Object.values(response);

    var areaChartData = {
        labels  : ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
        datasets: [
            {
                label               : 'Решено задач',
                backgroundColor     : 'rgba(60,141,188,0.9)',
                borderColor         : 'rgba(60,141,188,0.8)',
                pointRadius          : false,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : tasksCount.map(category => category.userTasksCount)
            },
            {
                label               : 'Всего задач',
                backgroundColor     : 'rgba(210, 214, 222, 1)',
                borderColor         : 'rgba(210, 214, 222, 1)',
                pointRadius         : false,
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : tasksCount.map(category => category.totalTasksCount)
            },
        ]
    }

    var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines : {
                    display : true,
                }
            }],
            yAxes: [{
                gridLines : {
                    display : true,
                },
                ticks: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }]
        }
    }

    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    });
}
