<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 11.11.18
 * Time: 19:51
 */

namespace Controllers;


use App\{Controller,Exeption};
use Models\{Chats_Model, Orders_Model, Users_Models};

class AdminController extends Controller
{
    public function actionIndex()
    {
        $orders_model = Orders_Model::getInstance();
        $orders = $orders_model->getOrders();
        $links = $orders_model->links;
        $data['orders'] = $orders;
        $data['links'] = $links;

        return $this->render('table', $data);
    }
    public function actionOpen($id)
    {
        //echo $id;
       // $this->errors_list = 'проверка,хотя';
        $orders = Orders_Model::getInstance()->getOrderById($id);
        $orders['form_action'] = '/admin_form';
        $users = Users_Models::getInstance()->getUsers();
        $chats = Chats_Model::getInstance()->GetChats($id);
        $orders['users'] = $users;
        $orders['chats'] = $chats;
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
    public function actionFormer()
    {

        return $this->render('former');

    }

}