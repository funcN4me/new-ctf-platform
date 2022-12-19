$(document).ready(function () {
    $('.resource-card').on('click', function () {
        window.location = '/resources/resource/' + $(this).data('resource-id');
    });
});
