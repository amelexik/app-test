$(document).ready(function () {

    /**
     * Ответ
     */
    $('.reply').click(function () {
        var commentId = $(this).data('commentId');
        var header = 'Новый коментарий';
        if(!isNaN(commentId) && commentId > 0){
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
    $('.edit').click(function () {
        var commentId = $(this).data('commentId');
        var text = '';
        if(!isNaN(commentId) && commentId > 0){
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





    $(".comment").unbind().click(function () {

        var currentComment = $(this).data("commentid");

        $("#commentactions-" + currentComment).slideDown("fast");

    });


    $(".commentLi").hover(function () {

        var currentComment = $(this).data("commentid");

        $("#comment-" + currentComment).stop().animate({
            opacity: "1",
            backgroundColor: "#f8f8f8",
            borderLeftWidth: "4px"
        }, {
            duration: 100, complete: function () {
            }
        });

    }, function () {

        var currentComment = $(this).data("commentid");

        $("#comment-" + currentComment).stop().animate({
            opacity: "1",
            backgroundColor: "#fff",
            borderLeftWidth: "1px"
        }, {
            duration: 100, complete: function () {
            }
        });

        $("#commentactions-" + currentComment).slideUp("fast");

    });

});
