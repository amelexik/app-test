<?php

/**
 * Class Comments
 */
Class Comments extends Model
{

    public static $pageSize = 5;
    /**
     * @var string
     */
    var $table = 'comments';

    /**
     * @param $url
     * @param int $offset
     * @param int $size
     * @param bool $tree
     * @return array
     */
    public function getComments($url, $offset = 0, $size = 100)
    {
        if (!$url) return [];

        $where = "{$this->table}.url = :url AND {$this->table}.pid IS NULL";

        $query = "SELECT  
                  {$this->table}.*,
                  users.user_id,
                  users.login,
                  '1' as level 
                  FROM {$this->table} 
                  LEFT JOIN users ON users.user_id = {$this->table}.user
                  WHERE {$where}
                  ORDER BY created DESC
                  LIMIT $offset,$size";

        $params = [':url' => $url];

        $data = $this->db->queryAll($query, $params);

        if (!empty($data)) {
            foreach ($data as &$item) {
                $item['children'] = $this->getChildren($item['comment_id']);
            }
        }

        return $data;
    }

    /**
     * @param $pk
     * @return array
     */
    public function getByPk($pk)
    {
        if (!$pk) return [];

        $where = "{$this->table}.comment_id = :comment_id ";

        $query = "SELECT  
                  {$this->table}.*,
                  users.user_id,
                  users.login
                  FROM {$this->table} 
                  LEFT JOIN users ON users.user_id = {$this->table}.user
                  WHERE {$where}";

        $params = [':comment_id' => (int)$pk];

        $data = $this->db->queryRow($query, $params);
        return $data;
    }

    /**
     * @param $pk
     * @return array
     */
    public function deleteByPk($pk)
    {
        if (!$pk) return [];

        $where = "{$this->table}.comment_id = :comment_id ";

        $query = "DELETE FROM {$this->table} WHERE {$where}";

        $params = [':comment_id' => (int)$pk];

        return $this->db->execute($query, $params);
    }


    /**
     * @param $pk
     * @return array
     */
    public function updateByPk($pk, $message)
    {
        if (!$pk) return [];

        $where = "{$this->table}.comment_id = :comment_id ";

        $query = "UPDATE {$this->table} SET text=:text WHERE {$where}";

        $params = [
            ':comment_id' => (int)$pk,
            'text'        => $message
        ];
        return $this->db->execute($query, $params);
    }


    /**
     * @param $id
     * @param int $level
     * @return mixed
     */
    private function getChildren($id, $level = 1)
    {

        $size = 50;
        $level++;

        $where = "{$this->table}.pid=:pid";

        $query = "SELECT  
                  {$this->table}.*,
                  users.user_id,
                  users.login,
                  '{$level}' as level  
                  FROM {$this->table} 
                  LEFT JOIN users ON users.user_id = {$this->table}.user
                  WHERE {$where}
                  ORDER BY created DESC
                  LIMIT $size";
        $params = [
            ':pid' => $id
        ];

        $data = $this->db->queryAll($query, $params);

        foreach ($data as &$item) {
            $item['children'] = $this->getChildren($item['comment_id'], $level);
        }

        return $data;
    }

    /**
     * @param $user
     * @param $message
     * @return mixed
     */
    public
    function add($user, $message, $parent_id = null)
    {
        $query = "INSERT INTO {$this->table} (user,text,pid) VALUES (:user,:message,:pid)";
        $params = [
            ':user'    => $user,
            ':message' => $message,
            ':pid'     => $parent_id,
        ];
        return $this->db->execute($query, $params);
    }

    public function getTotalCount(){
        return (int) $this->db->queryScalar("SELECT count(comment_id) FROM {$this->table} WHERE pid IS NULL");
    }

    public function getTotalPages(){
        return ceil($this->getTotalCount() / self::$pageSize);
    }
}