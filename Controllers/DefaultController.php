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
        $this->layoutFile=('../Views/bootstrap.php');
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
        //Db::getModel('orders');
        //Db::getModel('orders');

    }
    public function actionManager()
    {
        $orders_model = Orders_Model::getInstance();
        $orders = $orders_model->getOrders();
        $links = $orders_model->links;
        $data['orders'] = $orders;
        $data['links'] = $links;
        return $this->render('table_manager', $data);
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
        return $this->render('form_for_costumer', $orders);
    }

    public function actionImage_show()
    {
       return $this->render('index');
    }
    public function actionTrigger()
    {
       $result =  Triggers_Models::getInstance()->CheckTrigger(2);
       $result = json_encode($result);
       echo $result;
    }
}