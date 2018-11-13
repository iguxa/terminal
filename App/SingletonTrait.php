<?php
namespace App;
trait SingletonTrait
{
    protected static $_instance = array();


    public static function getInstance($data = null)
    {
        return (!isset(self::$_instance[static::class])) ? self::$_instance[get_called_class()] = new static($data) : self::$_instance[get_called_class()];
    }

    protected function init($data = null)
    {
    }

    private function __construct($data = null)
    {
        $this->init($data);
    }

    private function __wakeup()
    {
    }

    private function __clone()
    {
    }
}