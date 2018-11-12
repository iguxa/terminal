<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 12.11.18
 * Time: 23:43
 */

namespace Models;


use App\{Db,Exeption,Confing};

class Triggers_Models extends Db
{
    protected static $_instance;
    protected $tb_name = 'orders';
    protected $orders_id;
    protected $order;
    protected $disable_trigger;
    protected $trigger;

    public function init($data = null)
    {
        parent::__construct($data = null);
        $trigger_config = Confing::getConfig('trigger');
        $this->disable_trigger = $trigger_config['disable'];
        $this->orders_id = $data;
        $this->setOrderInfo();
        $this->setTrigger();

    }

    public function Trigger():void
    {
        if($this->order['status_id'] == $this->disable_trigger){
            $this->deleteTrigger();
        }else{
            $this->createTrigger();
        }
    }
    public function getTrigger() :void
    {

    }
    public function setTrigger() :void
    {
        $sql = "SELECT * FROM $this->db_name.$this->tb_name where orders_id = :orders_id";
        $params = ['orders_id' => $this->orders_id];
        $this->Execute($sql,$params);
        $this->trigger = $this->status ? $this->status->fetch() : null;

    }
    public function setOrderInfo():void
    {
        Orders_Model::getInstance()->getOrderById($this->orders_id);
        $order = $this->status ? $this->status->fetch() : null;
        $this->order = $order;
    }
    public function createTrigger():void
    {
        if($this->trigger){
            $sql = "UPDATE $this->db_name.$this->tb_name SET users_id = :users_id WHERE id = :orders_id";
            $params = array(
                'users_id' => $this->order['users_id'],);
        }else{
            $sql = "INSERT INTO $this->db_name.$this->tb_name (users_id,orders_id)
                VALUES (:users_id,:orders_id);";
            $params = array(
                'users_id' => $this->order['users_id'],
                'orders_id' => $this->order['orders_id'],
                );
        }
        $this->Execute($sql,$params);

    }
    public function deleteTrigger():void
    {
        $sql = "DELETE FROM $this->db_name.$this->tb_name WHERE oreders_id = :orders_id);";
        $params = array(
            'orders_id' => $this->order['orders_id'],
        );
    }

}