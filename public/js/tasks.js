// tasks.js
$(document).ready(function() {
    $('#task-list-footer').hide();

    $('.add-task-btn-wrapper').on('click',function() {
        $('#task-list-footer').show();
    });

    $('#close-task-panel').click(function() {
        $('#task-list-footer').hide();
    });
});
$(document).ready(function() {
    $('#task-list-footer').hide();

    $('.add-task-btn-wrapper').on('click', function() {
        $('#task-list-footer').show();
    });

    $('#close-task-panel').click(function() {
        $('#task-list-footer').hide();
    });







    $(document).on('click', '.delete-btn', function() {
        $(this).closest('.task').remove();
    });
});


    $(document).on('click', '.delete-btn', function () {
        //
        $(this).closest('.task').remove();


    });
