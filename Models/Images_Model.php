<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 11.11.18
 * Time: 2:11
 */

namespace Models;
use App\{Db,Exeption};

class Images_Model extends Db
{
    protected static $_instance;
    protected $tb_name = 'images';
    public function InsertImages(int $orders_id, array $request)
    {
        $sql = "INSERT INTO $this->db_name.$this->tb_name (orders_id, images)
                VALUES (:orders_id, :images);";
        foreach ($request['images'] as $image){
            $params = [
                'orders_id' => $orders_id,
                'images' => $image,
            ];
            $result = $this->Execute($sql,$params);
        }
        return $result;
    }
    public function getImagesByOrderId($id)
    {
        $sql = "SELECT $this->tb_name.images FROM $this->db_name.$this->tb_name
                where $this->tb_name.orders_id = :id ";
        $params = ['id'=>$id];
        $result = $this->Execute($sql,$params);
        if($result){
            $images = $this->status->fetchAll();
        }else{
            return Exeption::getInstance()->error404($this->status->errorInfo());
        }

        return $images;
    }

}