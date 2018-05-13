<?php if ($comments = Comments::model()->getComments()) { ?>

    <div class="chatContainer">

        <div class="chatTitleContainer">Comments</div>
        <div class="chatHistoryContainer">

            <ul class="formComments">
                <?php foreach ($comments as $comment) { ?>
                    <li class="commentLi commentstep-1" data-commentid="<?= $comment['comment_id']; ?>">
                        <table class="form-comments-table">
                            <tr>
                                <td>
                                    <div class="comment-timestamp"><?= $comment['created']; ?></div>
                                </td>
                                <td>
                                    <div class="comment-user"><?= $comment['login']; ?></div>
                                </td>
                                <td>
                                    <div class="comment-avatar">
                                        <img src="https://cdn4.iconfinder.com/data/icons/evil-icons-user-interface/64/avatar-128.png">
                                    </div>
                                </td>
                                <td>
                                    <div id="comment-<?= $comment['comment_id']; ?>"
                                         data-commentid="<?= $comment['comment_id']; ?>" class="comment comment-step1">
                                        <div><?= $comment['text']; ?></div>
                                        <div id="commentactions-<?= $comment['comment_id']; ?>" class="comment-actions">
                                            <div class="btn-group" role="group" aria-label="...">
                                                <button type="button" class="btn btn-primary btn-sm"><i
                                                            class="fa fa-edit"></i> Reply
                                                </button>
                                                <button type="button" class="btn btn-default btn-sm"><i
                                                            class="fa fa-pencil"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash"></i>Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </li>
                <?php } ?>
            </ul>


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

<?php } ?>