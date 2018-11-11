<?php
namespace App;
trait HelperTrait
{
    public function date_format($date)
    {
        return date_format(date_create($date), 'H:i d-m-Y');
    }
}