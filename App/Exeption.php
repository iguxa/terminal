<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 10.11.18
 * Time: 3:49
 */

namespace App;


class Exeption
{
    use SingletonTrait;
    public static function not_found()
    {
        echo 'страница не найдена';
    }
    public static function access_denied()
    {
        echo'доступ закрыт';
    }
    public function error404($errors = null)
    {
        if($errors){
            echo '<pre>';
            var_dump($errors);
            echo '<pre>';
        }
        return  header("HTTP/1.0 404 Not Found");
    }
}