<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 10.11.18
 * Time: 22:00
 */

namespace App;

class Confing
{
    public $_paramsPath = '../config/';
    public static $name;
    public static $config;
    public static $_instance;

    private function __construct()
    {
       $this->setConfig();
    }

    public static function getConfig($key_params) : ?array
    {
        (static::$_instance == null) ? static::$_instance = new static() : static::$_instance;

        foreach (static::$config as $key => $params){
            if($key == $key_params){
                return $params;
            }
        }
        return null;
    }
    public function setConfig()
    {
        $config = null;
        $ap_params = include_once($this->_paramsPath.'app.php');
        foreach ($ap_params as $param){
            $config[$param] = include_once($this->_paramsPath.$param.'.php');
        }
        static::$config = $config;
    }

}