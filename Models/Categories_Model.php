<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 10.11.18
 * Time: 17:26
 */
namespace Models;
use App\Db;
class Categories_Model extends Db
{
    protected $tb_name = 'categories';


    public function getCategories(): ?array
    {
        $sql = "SELECT * FROM $this->db_name.$this->tb_name;";
        $statement = $this->getPdo($sql);
        while ($row = $statement -> fetch())
        {
            $result[] = $row;
        }
        return $result;
    }
}