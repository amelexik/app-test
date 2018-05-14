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
                header('location:/');
                die();
            }
        }

    }

    /**
     *
     */
    public function actionLogout()
    {
        identity()->logoutUser();
        header('location:/');
        die();
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
        header('location:/');
        die();
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
                        Comments::model()->updateByPk($commentId,$message);
                    }
                }
            }
        }
        header('location:/');
        die();
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
        header('location:/');
        die();
    }


    /**
     * @param $data
     * @throws Exception
     */
    public static function renderComments($data)
    {
        $view = New View();
        echo $view->renderFile(VIEWS_PATH . DS . 'blocks' . DS . 'comments_block.php', $data);
    }
}