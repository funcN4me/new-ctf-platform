$(document).on('click', '.deleteTask', function () {
    let taskId = $(this).data('task-id');

    $.ajax({
        url: `/task/delete/${taskId}`,
        type: "GET",
        success: function (response) {
            $('#deleteModal').html(response);
            $('#deleteTaskModal').modal('show');
        }
    });
});

$(document).on('click', '.task', function (event) {
    if (!event.target.classList.contains('changeTask') && !event.target.classList.contains('deleteTask')) {
        let taskId = $(this).data('task-id');

        $.ajax({
            url: `/task/show/${taskId}`,
            type: "GET",
            success: function (response) {
                $('#taskModal').html(response);
                $('#showTaskModal').modal('show');
            }
        });
    }
});

$('.taskCategories').on('change', function () {
    $('.noneTasks').remove();
    $(`.categoryContainer`).each(function () {
        $(this).addClass('d-none');
    });

    let chosenCategory = $('.categoryContainer[data-category-id=' + $(this).val() + ']');

    chosenCategory.removeClass('d-none');

    if ($(this).val() === 'all') {
        $(`.categoryContainer`).each(function () {
            $(this).removeClass('d-none');
        });
    }

    if (!chosenCategory.length && $(this).val() !== 'all') {
        $('.categoryContainer').parent().append('<h3 class="col-12 noneTasks">Нет задач в этой категории</h3>');
    }
})

$(document).on('click', '.deleteFile', function (event) {
    event.preventDefault();

    let parentLink = $(this).closest('.taskFile');

    let fileId = $(this).data('file-id');

    $.ajax({
        url: `/task/file/delete/${fileId}`,
        type: "GET",
        success: function (response) {
            parentLink.hide();

            const swAlertSuccess = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            swAlertSuccess({
                type: 'success',
                title: response.message,
                padding: '2em',
            });
        }
    })
});
