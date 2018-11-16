<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 09.11.18
 * Time: 1:00
 */
namespace App;

class Db
{
    use SingletonTrait;
    //protected static $_instance;
    protected $connection;
    protected $db_name;
    protected $status;
    public $db_config;

    protected function init($data = null)
    {
        $this->db_config = Confing::getConfig('db_params');
        $this->connection = $this->getConnection();
    }
    public static function getModel($name)  {
        $class = ucfirst($name).'_Model';
        if(class_exists($class)) {
           return $class::getInstance();
        }
    }

    protected function getConnection()
    {
        $this->db_name = $this->db_config['dbname'];
        $dsn = 'mysql:dbname='.$this->db_config['dbname'].';host='.$this->db_config['host'];
        $db = new \PDO($dsn,$this->db_config['user'],$this->db_config['password'],$this->db_config['options']);
        return  $db;
    }
    protected function Execute($sql,array $params = null)
    {
        try {
            $result = $this->connection->prepare($sql);
            $execute = $result->execute($params);
            $this->status = $result;
            return $execute;
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
            die();
        }
    }


    public function getPdo($sql){
        $db = $this->connection;
        $result = $db -> prepare($sql);
        $result -> execute();
        return $result;
    }
    public function UpdateByParams(array $params,array $id)
    {
        //$params = array_diff($params, array(''));
        $params_count = count($params);
        $counter = 0;
        $sql = '';
        $key_id = $id['key'];
        $value_id = $id['value'];
        foreach ($params as $key => $param){
            $sql .= ' , '.$key.'=:'.$key;
            $params_new[$key] = $param;
            if(++$counter == $params_count){
                $sql = trim($sql, ', ');
                $sql .= ' WHERE '.$value_id.'= :'.$value_id;
                break;
            }
        };
        $sql = "UPDATE $this->db_name.$this->tb_name SET ".$sql;
        $params_new[$value_id] = $key_id;
        return $this->Execute($sql,$params_new);
    }
    /*public function getCategories(){
        $sql = "SELECT * FROM $this->db_name.categories;";
        $statement = $this->getPdo($sql);
        while ($row = $statement -> fetch())
        {
            $result[] = $row;
        }

        return $result;
    }



    public static function changeAnswer($sql,$id,$categorie,$value){
        $db = self::getConnection();
        $result = $db -> prepare($sql);
        $result -> execute(array('value' => $value,'id' => $id));
        return $categorie.' = '.$value;
    }
    public static function get_answer_bot($sql,$command){
        $db = self::getConnection();
        $result = $db -> prepare($sql);
        $result -> execute(array(':command' => $command));
        return $result;
    }
    public static function insertAnswer($sql,$question,$answer,$answer_details){
        $db = self::getConnection();
        $result = $db -> prepare($sql);
        $result -> execute(array(
            'question' => $question,
            'answer' => $answer,
            'answer_details' => $answer_details
        ));
        return $result;
    }
    public static function delete_id($sql,$id){
        $db = self::getConnection();
        $result = $db -> prepare($sql);
        $result -> execute(array(
            ':id' => $id,
        ));
        return $result;
    }*/
}