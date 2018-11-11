<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 10.11.18
 * Time: 3:36
 */

namespace App;


class Middleware
{
    protected $middleware;

    protected function __construct($middleware)
    {
        $this->middleware = $middleware;
    }
    public static function getMiddleware($middleware)
    {
        return new self($middleware);
    }
    public function check() :bool
    {
        $method = $this->middleware;
        return method_exists($this,$this->middleware) ? $this->$method() : false;
    }
    protected function auth() :bool
    {
        return ($this->middleware == 'auth') ? true : false;
    }

}