<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 12.11.18
 * Time: 23:30
 */

namespace Models;
use App\{Db,Exeption};

class Users_Models extends Db
{
    protected static $_instance;
    protected $tb_name = 'users';
    public function getUsers()
    {
        $sql = "SELECT * FROM $this->db_name . $this->tb_name";
        $params = null;
        $this->Execute($sql,$params);
        $users = $this->status->fetchAll();
        return $users;

    }
}