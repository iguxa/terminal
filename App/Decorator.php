<?php
/**
 * Created by PhpStorm.
 * User: tsybykov
 * Date: 13.11.18
 * Time: 12:32
 */

namespace App;

class Decorator
{
    protected $object = null;

    public function __construct(object $object)
    {
        $this->object = $object;
    }
    public function event($method, $data)
    {
    }

    public function __call($name, $arguments = null)
    {
        if (method_exists($this->object, $name))  {
            //$this->object->
            return call_user_func_array(array($this->object, $name), $arguments);

        }
        return null;
    }

    public function __get($name) {
        if(property_exists($this->object, $name)) {
            return $this->object->$name;
        }
        return null;
    }
    public function __set($name, $value)
    {
        $this->object->$name = $value;
    }
}