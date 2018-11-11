<?php
namespace App;
trait SingletonTrait
{
    protected static $_instance;

    public static function getInstance($data = null)
    {
        return (static::$_instance == null) ? static::$_instance = new static($data) : static::$_instance;
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