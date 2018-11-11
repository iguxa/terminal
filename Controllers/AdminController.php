<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 11.11.18
 * Time: 19:51
 */

namespace Controllers;


use App\Controller;
use Models\Orders_Model;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $orders = Orders_Model::getInstance()->getOrders();
        return $this->render('table', $orders);
    }
    public function actionOpen($id)
    {
        //echo $id;
        $orders = Orders_Model::getInstance()->getOrderById($id);
        return $this->render('form_for_manager', $orders);
    }

}