$(document).ready(function () {

    /**
     * Ответ
     */
    $(document).on('click', '.reply', function () {
        var commentId = $(this).data('commentId');
        var header = 'Новый коментарий';
        if (!isNaN(commentId) && commentId > 0) {
            $('#commentFormModal input[name="parent_id"]').val(commentId);
            header = 'Новый ответ на коментарий #' + commentId;
        }
        $('#commentFormModal #commentFormModalTitle').text(header);
        $('#commentFormModal').modal();
    });

    /**
     * сброс
     */
    $('#commentFormModal').on('hidden.bs.modal', function (e) {
        $('#commentFormModal input[name="parent_id"]').val('');
        $('#commentFormModal #commentFormModal').text('');
    });


    /**
     * Редактирование
     */
    $(document).on('click', '.edit', function () {
        var commentId = $(this).data('commentId');
        var text = '';
        if (!isNaN(commentId) && commentId > 0) {
            $('#updateFormModal input[name="comment_id"]').val(commentId);
            text = $('#comment-' + commentId + ' .text').text();
            $('#updateFormModal textarea').text(text);

        }
        $('#updateFormModal').modal();

    });

    /**
     * сброс
     */
    $('#updateFormModal').on('hidden.bs.modal', function (e) {
        $('#updateFormModal input[name="comment_id"]').val('');
        $('#updateFormModal textarea').text('');
    });


    /**
     * AJAX load comments
     */
    $(document).on('click', '.loadComments:enabled', function () {
        var page = $(this).data('nextPage');

        $(this).prop('disabled', true);
        var that = this;

        if (!isNaN(page) && page > 0) {
            $.ajax({
                type: 'post',
                url: '/site/loadComments',
                dataType: 'json',
                data: {
                    page: page
                },
                success: function (data) {
                    if ('messages' in data && data.messages != '') {
                        console.log(data.messages);
                        $('#loadComments').append(data.messages);
                    }
                    if ('pager' in data) {
                        $('#loadMoreButton').html(data.pager);
                    }
                },
                error: function () {

                },
            }).always(function () {
                $(that).prop('disabled', false);
            });
        }
    });

    $(document).on('click', '.comment', function () {

        var currentComment = $(this).data("commentid");

        $("#commentactions-" + currentComment).slideDown("fast");

    });


    $(document).on(
        {
            mouseenter: function () {
                //stuff to do on mouse enter

                var currentComment = $(this).data("commentid");

                $("#comment-" + currentComment).stop().animate({
                    opacity: "1",
                    backgroundColor: "#f8f8f8",
                    borderLeftWidth: "4px"
                }, {
                    duration: 100, complete: function () {
                    }
                });
            },
        }
    );

});
