<?php foreach ($data['comments'] as $comment) { ?>
    <li class="commentLi commentstep-<?= $comment['level']; ?>" data-commentid="<?= $comment['comment_id']; ?>">
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
                        <div class="text"><?= $comment['text']; ?></div>
                        <div id="commentactions-<?= $comment['comment_id']; ?>" class="comment-actions">
                            <div class="btn-group" role="group" aria-label="...">
                                <?php if ($comment['user'] == identity()->getId()) { ?>
                                    <button data-comment-id="<?= $comment['comment_id']; ?>"
                                            type="button"
                                            class="edit btn btn-default btn-sm"><i
                                                class="fa fa-pencil"></i> Edit
                                    </button>
                                    <a onclick="return confirm('Confirm?');" href="/site/deleteComment?comment_id=<?= $comment['comment_id']; ?>"
                                       class="btn btn-danger btn-sm"><i
                                                class="fa fa-trash"></i>Delete
                                    </a>
                                <?php } else { ?>
                                    <button data-comment-id="<?= $comment['comment_id']; ?>"
                                            type="button"
                                            class="reply btn btn-primary btn-sm"><i
                                                class="fa fa-edit"></i> Reply
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </li>


    <? if ($comment['children']) echo SiteController::renderComments(['comments' => $comment['children']]); ?>

<?php } ?>