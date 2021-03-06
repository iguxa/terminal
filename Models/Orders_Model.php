<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 11.11.18
 * Time: 1:34
 */

namespace Models;
use App\{Db,Exeption,Confing};

class Orders_Model extends Db
{
   /// protected static $_instance;
    protected $tb_name = 'orders';
    public $orders_id;
    protected $request;
    protected $orders_config;
    public $links;

    public function init($data = null)
    {
        parent::init($data);
        $this->request = $data;
        $this->orders_config = Confing::getConfig('orders_params');
    }

    public function setOrders_id($orders_id) :void
    {
        $this->orders_id = $orders_id;
    }

    public function createOrder()
    {
        $request = $this->request;
        $sql = "INSERT INTO $this->db_name.$this->tb_name (users_id, categories_id, item,description,discount,sum1,sum2,manager_comment,type_link)
                VALUES (:users_id, :categories_id, :item,:description,:discount,:sum1,:sum2,:manager_comment,:type_link);";
        $params = array(
            'users_id' => $request['users_id'],
            'categories_id' => $request['categories_id'],
            'item' => $request['item'],
            'description' => $request['description'],
            'discount' => $request['discount'],
            'sum1' => $request['sum1'],
            'sum2' => $request['sum2'],
            'manager_comment' => $request['manager_comment'],
            'type_link' => $request['type_link'],
            );

        $result = $this->Execute($sql,$params);
        if($result){
            $orders_id = $this->connection->lastInsertId();
            $this->setOrders_id($orders_id);
            Images_Model::getInstance()->InsertImages($this->orders_id,$request);
            $sql = "UPDATE $this->db_name.$this->tb_name SET images_id = :orders_id WHERE id = :orders_id";
            $params = array(
                'orders_id' => $this->orders_id,);
            $result = $this->Execute($sql,$params);
            if(!$result){
                return Exeption::getInstance()->error404($this->status->errorInfo());
            }
        }else{
            return Exeption::getInstance()->error404($this->status->errorInfo());
        }

        Triggers_Models::getInstance($orders_id)->Trigger();
        return $result;
    }
    public function getOrders()
    {
        $sql = "SELECT orders.id,orders.type_link, orders.status_id,orders.date,orders.discount,orders.item,orders.description,orders.sum1,orders.sum2,status.status FROM $this->db_name.$this->tb_name
                JOIN status on orders.status_id=status.id order by orders.id desc ";
        $sql = $this->limit($sql);
        $result = $this->getPdo($sql)->fetchAll();
        return $result;
    }
    public function getOrderById($id)
    {
        $sql = "SELECT orders.*,status.status,categories.categories FROM $this->db_name.$this->tb_name
                JOIN status on orders.status_id=status.id
                JOIN categories on orders.categories_id=categories.id
                JOIN users on orders.users_id = users.id
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
    public function ChangeOrderById($params = null)
    {
        $request = $this->request;
        $params = array(
            'status_id' => $request['status_id'],
            'sum1' => $request['sum1'],
            'sum2' => $request['sum2'],
            'users_id' => $request['users_id'],
            'admin_comment'=>$request['admin_comment'],
            'need_check'=>  $request['need_check'],
        );
        $id['key'] = $request['orders_id'];
        $id['value'] = 'id';
        $result = $this->UpdateByParams($params,$id);

        if(!$result){
            return Exeption::getInstance()->error404($this->status->errorInfo());
        }
        Triggers_Models::getInstance($request['orders_id'])->Trigger();

        return $result;
    }
    protected function limit($sql)
    {
        $limit = $this->orders_config['limit'];
        $counter = $this->getPdo($sql)->rowCount();
        $page =  isset($_GET['page']) ? ($_GET['page']-1) : 0;
        $start = abs($page*$limit);
        $num_pages = ceil($counter/$limit);
        for($i=1;$i<=$num_pages;$i++) {
            $links[] = $i;
        }
        $this->links = $links ?? null;
        return $sql."LIMIT $start,$limit";
    }
    public function getTotalByStatus($status = null)
    {
        $status_id = $status ?? 2;
        $sql = "SELECT sum($this->tb_name.sum1) as 'sum1',sum($this->tb_name.sum2) as 'sum2' FROM $this->db_name.$this->tb_name where status_id = :status_id";
        $params = [
            'status_id' => $status_id,
        ];
        $result = $this->Execute($sql,$params);
        if(!$result){
            return Exeption::getInstance()->error404($this->status->errorInfo());
        }
        $total = $this->status->fetch();
        return $total;
    }

}