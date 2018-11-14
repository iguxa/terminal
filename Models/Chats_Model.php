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
    public function init($data = null)
    {
        parent::init($data);
    }


    public function CreateMessage($request)
    {
        $order = Orders_Model::getInstance()->getOrderById($request['orders_id']);

        $sql = "INSERT INTO $this->db_name.$this->tb_name (users_id, orders_id, messages)
                VALUES (:users_id, :orders_id, :messages);";
        $params = array(
            'users_id' => $order['order']['users_id'],
            'orders_id' => $request['orders_id'],
            'messages' => $request['messages'],
        );
        return $this->Execute($sql,$params);
    }
    public function GetChats($id)
    {
        $sql = "SELECT chats.id,chats.messages,chats.date,users.position,users.id,users.users FROM $this->db_name.$this->tb_name
                JOIN users on users.id=chats.users_id  
                where orders_id=:orders_id  order by chats.id desc";
        $params = [
            'orders_id' => $id,

        ];
        $this->Execute($sql,$params);
        $chats = $this->status->fetchAll();
        return $chats;
    }

}