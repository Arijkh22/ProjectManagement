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

    $('#add-task').click(function() {
        var newTask = $('#new-task').val();

        if (newTask.trim() === "") {
            $('.error-message').removeClass('hidden');
            return;
        }

        var newTaskItem = $('<li class="task"></li>');
        var taskContainer = $('<div class="task-container"></div>');

        taskContainer.append('<span class="task-action-btn task-check"><span class="action-circle large complete-btn" title="Mark Complete"><i class="material-icons">check</i></span></span>');
        taskContainer.append('<span class="task-label" contenteditable="true">' + newTask + '</span>');
        taskContainer.append('<span class="task-action-btn task-btn-right"><span class="action-circle large" title="Assign"><i class="material-icons">person_add</i></span><span class="action-circle large delete-btn" title="Delete Task"><i class="material-icons">delete</i></span></span>');

        newTaskItem.append(taskContainer);
        $('#task-list').append(newTaskItem);

        $('#new-task').val('');

        $('.error-message').addClass('hidden');
    });

    $('#close-task-panel').click(function() {
        $('#task-list-footer').hide();
    });
});


$(document).on('click', '.delete-btn', function() {
    //
    $(this).closest('.task').remove();


});
