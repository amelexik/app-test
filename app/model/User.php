<?php

/**
 * Class User
 */
Class User extends Model{
    var $table = 'users';

    /**
     * @param $login
     * @return mixed
     */
    public function findByLogin($login){
        $query = "SELECT * FROM {$this->table} WHERE login=:login";
        $params = [':login' => $login];
        $result = $this->db->queryRow($query,$params);
        return $result;
    }
}