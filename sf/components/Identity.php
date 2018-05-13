<?php
/**
 * todo разрабоать компонент Session
 */
session_start();

/**
 * Class Identity
 */
Class Identity extends Component
{
    public function __construct($config)
    {
        parent::__construct($config);

        if (!isset($_SESSION['user']))
            $_SESSION['user'] = null;

        if (!empty($_SESSION['user'])) {
            $this->_id = $_SESSION['user']['user_id'];
            $this->_login = $_SESSION['user']['login'];
        }
    }

    /**
     * @var
     */
    private $_id;
    /**
     * @var
     */
    private $_login;

    /**
     * @return bool
     */
    public function getIsGuest()
    {
        return !$this->_id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->_login;
    }


    /**
     * @param $data
     * @param null $model
     * @return bool
     */
    private function identity($data, $model = null)
    {
        if (!$data['login'] || !$data['password'] || !$model)
            return false;

        if (md5($data['password']) == $model['password']){
            return true;
        }


        return false;

    }

    /**
     * @param $data
     * @return bool
     */
    public function authenticate($data){
        $model = User::model()->findByLogin($data['login']);
        if($model){
            if($this->identity($data,$model)){
                $this->authUser($model);
                return true;
            }
        }
        return false;
    }

    /**
     * @param $data
     */
    private function authUser($data)
    {
        $this->_id = $data['user_id'];
        $this->_login = $data['login'];

        $_SESSION['user'] = $data;
    }

    /**
     *
     */
    public function logoutUser()
    {
        $_SESSION['user'] = null;
    }
}