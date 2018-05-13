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
}