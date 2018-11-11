<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 11.11.18
 * Time: 20:37
 */

namespace App;

class View
{
    public function date_format($date)
    {
       return date_format(date_create($date), 'H:i d-m-Y');
    }
}