<?php

/**
 * Class Comments
 */
Class Comments extends Model
{
    var $table = 'comments';

    public function getComments($offset = 0, $size = 100, $tree = true)
    {
        $query = "SELECT  {$this->table}.*, users.user_id, users.login 
                  FROM {$this->table} 
                  LEFT JOIN users ON users.user_id = {$this->table}.user
                  ORDER BY created DESC
                  LIMIT $offset,$size";
        $data = $this->db->queryAll($query);
        return $data;
    }

    public function add($user, $message)
    {
        $query = "INSERT INTO {$this->table} (user,text) VALUES (:user,:message)";
        $params = [
            ':user' => $user,
            ':message' => $message,
        ];
        return $this->db->execute($query, $params);
    }
}