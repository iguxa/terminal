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
    protected $tb_name = 'triggers';
    protected $orders_id;
    protected $order;
    protected $disable_trigger;
    protected $trigger;
    protected $trigger_id;

    public function init($data = null)
    {
        parent::init($data);
        //$trigger_config = Confing::getConfig('trigger_params');
        //$this->disable_trigger = $trigger_config['disable'];
        $this->orders_id = $data;
        $this->setOrderInfo();
        $this->TriggerExists();
    }

    public function Trigger():void
    {
        /*if($this->order['status_id'] == $this->disable_trigger){
            $this->deleteTrigger();
        }else{
            $this->createTrigger();
        }*/

        $this->createTrigger();

    }
    public function getTrigger() :void
    {

    }
    public function setTrigger() :void
    {
        $sql = "SELECT status_id FROM $this->db_name.$this->tb_name where id = :orders_id";
        $params = ['orders_id' => $this->orders_id];
        $this->Execute($sql,$params);
        $this->trigger = $this->status ? $this->status->fetch() : null;

    }
    public function setOrderInfo():void
    {
        $orders =  Orders_Model::getInstance()->getOrderById($this->orders_id);
        $order = $orders ? $orders['order'] : null;
        $this->order = $order;
    }
    public function createTrigger():void
    {
        if($this->trigger_id){
            $sql = "UPDATE $this->db_name.$this->tb_name SET users_id = :users_id WHERE id = :id";
            $params = array(
                'users_id' => $this->order['users_id'],
                'id' => $this->trigger_id['id'],
                );
        }else{
            $sql = "INSERT INTO $this->db_name.$this->tb_name (users_id,orders_id)
                VALUES (:users_id,:orders_id);";
            $params = array(
                'users_id' => $this->order['users_id'],
                'orders_id' => $this->order['id'],
                );
        }
        $this->Execute($sql,$params);

    }
    public function deleteTrigger():void
    {
        $sql = "DELETE FROM $this->db_name.$this->tb_name WHERE orders_id = :orders_id and id = :trigger_id;";
        $params = array(
            'orders_id' => $this->order['id'],
            'trigger_id' =>$this->trigger_id['id']
        );
        $this->Execute($sql,$params);
    }
    public function TriggerExists() :void
    {
        $sql = "SELECT id FROM $this->db_name.$this->tb_name where orders_id= :orders_id LIMIT 1";
        $params = ['orders_id' => $this->order['id']];
        $this->Execute($sql,$params);
        $this->trigger_id = $this->status ? $this->status->fetch() : null;
    }
    public function CheckTrigger($id)
    {
        $sql = "SELECT * FROM $this->db_name.$this->tb_name where users_id= :users_id";
        $params = [
            'users_id' => $id,
        ];
        $this->Execute($sql,$params);
        $result = $this->status->fetchAll();
        return $result;
    }

}