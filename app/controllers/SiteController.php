<?php

/**
 * Class SiteController
 * @var $identity Identity
 */
Class SiteController extends Controller
{
    public function actionIndex()
    {
        if ($_POST) {
            $login = Sf::app()->Request->getPost('login');
            $password = Sf::app()->Request->getPost('password');

            if (!empty($login) && !empty($password)) {
                $auth = Sf::app()->Identity->authenticate(['login' => $login, 'password' => $password]);
                header('location:/');
                die();
            }
        }

    }

    public function actionLogout()
    {
        $identity = Sf::app()->Identity;
        $identity->logoutUser();
        header('location:/');
        die();
    }

    public function actionPostComment(){
        if(!Sf::app()->Identity->getIsGuest()){
            $message = strip_tags(Sf::app()->Request->getPost('message'));
            if(!empty($message)){
                Comments::model()->add(Sf::app()->Identity->getId(),$message);
            }
        }
        header('location:/');
        die();
    }
}