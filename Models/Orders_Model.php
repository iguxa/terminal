<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 11.11.18
 * Time: 1:34
 */

namespace Models;
use App\{Db,Exeption};

class Orders_Model extends Db
{
    protected static $_instance;
    protected $tb_name = 'orders';

    public function createOrder($request)
    {
        $sql = "INSERT INTO $this->db_name.$this->tb_name (users_id, categories_id, item,description,discount,sum1,sum2)
                VALUES (:users_id, :categories_id, :item,:description,:discount,:sum1,:sum2);";
        $params = array(
            'users_id' => 1,
            'categories_id' => $request['categories_id'],
            'item' => $request['item'],
            'description' => $request['description'],
            'discount' => $request['discount'],
            'sum1' => $request['sum1'],
            'sum2' => $request['sum2'],
            );

        $result = $this->Execute($sql,$params);
        if($result){
            $orders_id = $this->connection->lastInsertId();
            Images_Model::getInstance()->InsertImages($orders_id,$request);
            $sql = "UPDATE $this->db_name.$this->tb_name SET images_id = :orders_id WHERE id = :orders_id";
            $params = array(
                'orders_id' => $orders_id,);
            $result = $this->Execute($sql,$params);
            if(!$result){
                return Exeption::getInstance()->error404($this->status->errorInfo());
            }
        }else{
            return Exeption::getInstance()->error404($this->status->errorInfo());
        }
        return $result;
    }
    public function getOrders()
    {
        $sql = "SELECT orders.id,orders.date,orders.discount,orders.item,orders.description,orders.sum1,orders.sum2,status.status FROM terminal.orders
                JOIN status on orders.status_id=status.id order by orders.id desc ";
        $result = $this->getPdo($sql)->fetchAll();
        return $result;
    }
    public function getOrderById($id)
    {
        $sql = "SELECT orders.*,status.status,categories.categories FROM terminal.orders
                JOIN status on orders.status_id=status.id
                JOIN categories on orders.categories_id=categories.id 
                where orders.id = :id ";
        $params = ['id'=>$id];
        $result = $this->Execute($sql,$params);
        if(!$result){
            return Exeption::getInstance()->error404($this->status->errorInfo());
        }
        $order = $this->status->fetch();
        $oreders_images = Images_Model::getInstance()->getImagesByOrderId($id);
        $option_status = Status_Model::getInstance()->GetStatusList();
        $data['order'] = $order;
        $data['orders_images'] = $oreders_images;
        $data['option_status'] = $option_status;
        return $data;
    }
    public function ChangeOrderById($request)
    {
        $sql = "UPDATE $this->db_name.$this->tb_name SET status_id = :status_id,sum1 = :sum1,sum2 = :sum2,comments=:comments,`check`=:check WHERE id = :orders_id";



        $params = array(
            'status_id' => $request['status_id'],
            'check' => $request['check'],
            'comments' => $request['comments'],
            'sum1' => $request['sum1'],
            'sum2' => $request['sum2'],
            'orders_id' => $request['orders_id'],
        );
        return $this->Execute($sql,$params);
    }
}