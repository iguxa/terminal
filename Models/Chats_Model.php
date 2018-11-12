<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 12.11.18
 * Time: 22:18
 */

namespace Models;
use App\{Db,Exeption};

class Chats_Model extends Db
{
    protected static $_instance;
    protected $tb_name = 'chats';

    public function CreateMessage($request)
    {
        $sql = "INSERT INTO $this->db_name.$this->tb_name (users_id, orders_id, messages)
                VALUES (:users_id, :orders_id, :messages);";
        $params = array(
            'users_id' => $request['users_id'],
            'orders_id' => $request['orders_id'],
            'messages' => $request['messages'],
        );
        return $this->Execute($sql,$params);
    }

}