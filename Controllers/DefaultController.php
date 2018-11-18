<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 09.11.18
 * Time: 1:03
 */

namespace Controllers;
use App\{Confing, Controller, Exeption, UploadImage,Db,Decorator};
use Models\{Categories_Model, Orders_Model, Status_Model, Triggers_Models, Users_Models, Chats_Model};

class DefaultController extends Controller
{
    public $layoutFile=('../Views/bootstrap.php');

    public function actionIndex($id)
    {
        if($_SERVER['REQUEST_URI'] != '/'){
            return Exeption::getInstance()->error404();
        };
        $categories = Categories_Model::getInstance()->getCategories();
        $users = Users_Models::getInstance()->getUsers();
        $status = Status_Model::getInstance()->GetStatusList();
        $params['categories'] = $categories;
        $params['users'] = $users;
        $params['status'] = $status;
        return $this->render('form',$params);
    }
    public function actionImage()
    {
        $request = $_POST ?: null;
        $images = $_FILES ?: null;
        if(!$request or !$images or $request['bot_check'] or !$request['item']){
            return Exeption::getInstance()->error404();
        }
        unset($request['bot_check']);
        unset($request['MAX_FILE_SIZE']);
        $uploaded = UploadImage::getInstance()->load($images);
        if($uploaded['status'] == 'success'){
            $request['images'] = $uploaded['uploaded_files'];
        }else{
            return Exeption::getInstance()->error404($uploaded['uploaded_files']);
        }

        $result = Orders_Model::getInstance($request)->createOrder();
        if($result){
            header('Location:/manager');
        }

    }
    public function actionManager()
    {
        $orders_model = Orders_Model::getInstance();
        $orders = $orders_model->getOrders();
        $total = $orders_model->getTotalByStatus();
        $links = $orders_model->links;
        $data['orders'] = $orders;
        $data['links'] = $links;
        $data['total'] = $total;
        return $this->render('table_manager', $data);
    }
    public function actionOpen($id)
    {
        $params = Orders_Model::getInstance()->getOrderById($id);
        $params['form_action'] = '/admin_form';
        $params['categories'] = Categories_Model::getInstance()->getCategories();
        return $this->render('manager', $params);
    }

    public function actionImage_show()
    {
       return $this->render('index');
    }
    public function actionTrigger()
    {
       $id = $_POST['users_id'] ?? null;
       if($id){

       $result =  Triggers_Models::getInstance()->CheckTrigger($id);
       $result = json_encode($result);
       echo $result;
       }else{
           $result = json_encode('Не найдено');
           echo $result;
       }
    }

    public function actionManager_form()
    {
        $categories = Categories_Model::getInstance()->getCategories();
        $params['categories'] = $categories;
        return $this->render('create_order',$params);
    }
    public function actionForm_fill()
    {
        $request = $_POST ?: null;
        $images = $_FILES ?: null;
        if(!$request or !$images or $request['bot_check'] or !$request['item']){
            return Exeption::getInstance()->error404();
        }
        unset($request['bot_check']);
        unset($request['MAX_FILE_SIZE']);
        $uploaded = UploadImage::getInstance()->load($images);
        if($uploaded['status'] == 'success'){
            $request['images'] = $uploaded['uploaded_files'];
        }else{
            return Exeption::getInstance()->error404($uploaded['uploaded_files']);
        }

        $result = Orders_Model::getInstance($request)->createOrder();
        if($result){
            header('Location:/manager');
        }
    }
    public function actionUpdate_form()
    {
        $request = $_POST ?: null;
        if($request['bot_check']){
            return Exeption::getInstance()->error404();
        }
        unset($request['bot_check']);

        $params = array(
            'users_id' => $request['users_id'],
            'manager_comment'=>$request['manager_comment'],
            'manager_result_test'=>$request['manager_result_test'],
        );
        $id['key'] = $request['orders_id'];
        $id['value'] = 'id';

        $order = Orders_Model::getInstance()->UpdateByParams($params,$id);

        Triggers_Models::getInstance($request['orders_id'])->Trigger();

        if($order){
            header('Location:'.$_SERVER['HTTP_REFERER']);
        }
    }
    public function actionTrigger_delete()
    {
        $orders_id = $_POST['orders_id'] ?? null;
        if(!$orders_id){
            return Exeption::getInstance()->error404('не найдено');
        }
        Triggers_Models::getInstance($orders_id)->deleteTrigger();

    }
    public function actionPay()
    {
        return $this->render('pay');
    }
    public function actionPay_form()
    {
        $request = $_POST ?: null;
        if(!$request or $request['bot_check'] or !$request['item']){
            return Exeption::getInstance()->error404();
        }
        unset($request['bot_check']);
        unset($request['MAX_FILE_SIZE']);
        $params = [
            'item' => $request['item'],
            'description' => $request['description'],
            'discount' => $request['discount'],
            'users_id' => $request['users_id'],
            'categories_id' => $request['categories_id'],
            'type_link' => $request['type_link'],
        ];
        $result = Orders_Model::getInstance();
         $result->Insert($params);
        $id = $result->connection->lastInsertId();
        Triggers_Models::getInstance($id)->Trigger();
        if(isset($result) and $result){
            header('Location:/manager');
        }else{
            return Exeption::getInstance()->error404('ошибка в создании');
        }
    }
    public function actionPay_open($id)
    {
        $params = Orders_Model::getInstance()->getOrderById($id);
        return $this->render('manager_pay', $params);
    }
}