<?php

/**
 * Class SiteController
 * @var $identity Identity
 */
Class SiteController extends Controller
{
    /**
     *
     */
    public function actionIndex()
    {
        if ($_POST) {
            $login = request()->getPost('login');
            $password = request()->getPost('password');

            if (!empty($login) && !empty($password)) {
                $auth = identity()->authenticate(['login' => $login, 'password' => $password]);
                Sf::app()->redirect('/');
            }
        }

    }

    /**
     *
     */
    public function actionLogout()
    {
        identity()->logoutUser();
        Sf::app()->redirect('/');
    }

    /**
     *
     */
    public function actionPostComment()
    {
        if (!Sf::app()->Identity->getIsGuest()) {
            $message = strip_tags(Sf::app()->Request->getPost('message'));
            $parent_id = Sf::app()->Request->getPost('parent_id', null);
            if (!empty($message)) {
                Comments::model()->add(identity()->getId(), $message, $parent_id);
            }
        }
        Sf::app()->redirect('/');
    }

    /**
     *
     */
    public function actionUpdateComment()
    {
        if (!identity()->getIsGuest()) {
            $commentId = request()->getParam('comment_id', 0);
            $message = strip_tags(request()->getPost('message'));
            $userId = identity()->getId();


            if ($commentId > 0) {
                // check owner
                if ($data = Comments::model()->getByPk($commentId)) {

                    if ($data['user'] == $userId) {
                        Comments::model()->updateByPk($commentId, $message);
                    }
                }
            }
        }
        Sf::app()->redirect('/');
    }

    public function actionLoadComments()
    {

        sleep(1);

        $data = ['messages' => '', 'pager' => ''];

        $page = intval(request()->getPost('page'));
        if (!$page) return;

        $total = Comments::model()->getTotalCount();
        $pages = ceil($total / Comments::$pageSize);


        if ($page <= $pages) {
            $offset = (Comments::$pageSize * ($page - 1));

            $page++;


            $data = [
                'messages' => Self::renderComments([
                    'comments' => Comments::model()->getComments('/', $offset, Comments::$pageSize)
                ]),
                'pager'    => $pages >= $page ? '<button data-next-page="' . $page . '" class="btn btn-primary loadComments">Загрузить предыдущие комментарии</button>' : ''
            ];
        }

        echo json_encode($data);
        Sf::app()->end();

    }


    /**
     *
     */
    public function actionDeleteComment()
    {
        if (!Sf::app()->Identity->getIsGuest()) {
            $commentId = Sf::app()->Request->getParam('comment_id', 0);
            $userId = Sf::app()->Identity->getId();
            if ($commentId > 0) {
                // check owner
                if ($data = Comments::model()->getByPk($commentId)) {
                    if ($data['user'] == $userId) {
                        Comments::model()->deleteByPk($commentId);
                    }
                }
            }
        }
        Sf::app()->redirect('/');
    }


    /**
     * @param $data
     * @throws Exception
     */
    public static function renderComments($data)
    {
        return View::renderFile(VIEWS_PATH . DS . 'blocks' . DS . 'comments_block.php', $data);
    }
}