<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 11.11.18
 * Time: 19:51
 */

namespace Controllers;


use App\{Controller,Exeption};
use Models\{Chats_Model, Orders_Model, Users_Models,Categories_Model,Triggers_Models};

class AdminController extends Controller
{
    public $layoutFile=('../Views/bootstrap_admin.php');

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
        $params = Orders_Model::getInstance()->getOrderById($id);
        $params['form_action'] = '/admin_form';
        $params['categories'] = Categories_Model::getInstance()->getCategories();
        return $this->render('admin', $params);
    }
    public function actionForm_fill()
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
    public function actionAdmin()
    {
        $orders_model = Orders_Model::getInstance();
        $orders = $orders_model->getOrders();
        $links = $orders_model->links;
        $data['orders'] = $orders;
        $data['links'] = $links;
        return $this->render('table_admin', $data);
    }
    public function actionPay_fill()
    {
        $request = $_POST ?: null;
        if($request['bot_check']){
            return Exeption::getInstance()->error404();
        }
        unset($request['bot_check']);

        $params = array(
            'users_id' => $request['users_id'],
            'sum2'=>$request['sum2'],
            'status_id'=>$request['status_id'],
        );
        $id['key'] = $request['orders_id'];
        $id['value'] = 'id';
        $order = Orders_Model::getInstance()->UpdateByParams($params,$id);
        Triggers_Models::getInstance($request['orders_id'])->Trigger();
        if($order){
            header('Location:/admin');
        }
    }
    public function actionPay_open($id)
    {
        $params = Orders_Model::getInstance()->getOrderById($id);
        return $this->render('admin_pay', $params);
    }

}