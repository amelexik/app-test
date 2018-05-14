<div class="chatContainer">
    <?php
    $comments = Comments::model()->getComments('/');
    ?>
    <div class="chatTitleContainer">Comments</div>
    <div class="chatHistoryContainer">
        <?php if ($comments = Comments::model()->getComments('/')) { // todo через Рекуест ккласт получить текщий УРЛ ?>
            <ul class="formComments">
                <?php Sf::app()->getController()->renderComments(['comments' => $comments]); ?>
            </ul>
        <?php } ?>
    </div>

    <form method="post" action="/site/postComment">
        <div class="input-group input-group-sm chatMessageControls">
            <span class="input-group-addon" id="sizing-addon3">Comment</span>
            <input name="message" type="text" class="form-control" placeholder="Type your message here.."
                   aria-describedby="sizing-addon3">
            <span class="input-group-btn">
            <button id="clearMessageButton" class="btn btn-default" type="reset">Clear</button>
            <button id="sendMessageButton" class="btn btn-primary" type="submit"><i class="fa fa-send"></i>Send</button>
        </span>
        </div>
    </form>
</div>

<?php
/**
 * Ответ
 */
?>
<div class="modal fade" id="commentFormModal" tabindex="-1" role="dialog" aria-labelledby="commentFormModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="/site/postComment">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="commentFormModalTitle"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Текст:</label>
                        <textarea class="form-control" name="message"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="parent_id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
/**
 * Редактирование
 */
?>
<div class="modal fade" id="updateFormModal" tabindex="-1" role="dialog" aria-labelledby="updateFormModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="/site/updateComment">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="updateFormModalTitle">Редактировать коментарий</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Текст:</label>
                        <textarea class="form-control" name="message"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="comment_id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div>