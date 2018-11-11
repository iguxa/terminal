<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 09.11.18
 * Time: 1:03
 */

namespace Controllers;
use App\{Confing, Controller, Exeption, UploadImage};
use Models\{Categories_Model,Orders_Model};

class DefaultController extends Controller
{
    public function actionIndex($id)
    {
        if($_SERVER['REQUEST_URI'] != '/'){
            return Exeption::getInstance()->error404();
        };
        $categories = Categories_Model::getInstance()->getCategories();
        $params['categories'] = $categories;
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
        Orders_Model::getInstance()->createOrder($request);

    }
    public function actionImage_show()
    {
       return $this->render('index');
    }
}