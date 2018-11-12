<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 11.11.18
 * Time: 23:56
 */

namespace Models;


use App\{Db,Exeption};

class Status_Model extends Db
{
    protected static $_instance;
    protected $tb_name = 'status';
    public function GetStatusList()
    {
        $sql = "SELECT * FROM $this->db_name.$this->tb_name";
        $this->Execute($sql);
        $result = $this->status->fetchAll();
        return $result;
    }

}