<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 11.11.18
 * Time: 19:51
 */

namespace Controllers;


use App\Controller;
use App\Exeption;
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
       // $this->errors_list = 'проверка,хотя';
        $orders = Orders_Model::getInstance()->getOrderById($id);
        $orders['form_action'] = '/admin_form';
        return $this->render('form_for_manager', $orders);
    }
    public function actionAdmin_form()
    {
        $request = $_POST ?: null;
        if($request['bot_check']){
            return Exeption::getInstance()->error404();
        }
        unset($request['bot_check']);
        $order = Orders_Model::getInstance($request)->ChangeOrderById();
        if($order){
            header('Location:'.$_SERVER['HTTP_REFERER']);
        }

    }

}