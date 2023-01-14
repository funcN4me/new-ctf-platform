$(document).ready(function () {
    let t=0; // the height of the highest element (after the function runs)
    let t_elem;  // the highest element (after the function runs)
    $(".resource-card").each(function () {
        $this = $(this);
        if ( $this.outerHeight() > t ) {
            t_elem=this;
            t=$this.outerHeight();
        }
    });
});

$(document).on('click', '.deleteResource', function () {
    let resourceId = $(this).data('resource-id');

    $.ajax({
        url: `/resources/resource/delete/${resourceId}`,
        type: "GET",
        success: function (response) {
            $('#deleteModal').html(response);
            $('#deleteTaskModal').modal('show');
        }
    });
});

$(document).on('click', '.resource-card', function (event) {
    if (!event.target.classList.contains('deleteResource')) {
        window.location = '/resources/resource/' + $(this).data('resource-id');
    }
});

$('.searchResource').on('input', function () {
    let input = $(this).val().toLowerCase();

    $('.resourceName').parents('.resource-card').addClass('d-none');

    $('.resourceName').each(function () {
        let resourceName = $(this).text();
        if (~resourceName.toLowerCase().indexOf(input)) {
            $(this).parents('.resource-card').removeClass('d-none');
        }
    })
})
