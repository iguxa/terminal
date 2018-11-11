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
    protected $connection;
    protected $db_name;
    protected $status;
    public $db_config;

    protected function __construct()
    {
        $this->db_config = Confing::getConfig('db_params');
        $this->connection = $this->getConnection();
    }

    public function __destruct()
    {
        $this->connection = null;
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
            $result->execute($params);
            $this->status = $result;
            return $result->execute($params);
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