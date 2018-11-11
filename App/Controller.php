<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 09.11.18
 * Time: 1:01
 */
namespace App;

class Controller
{
    use HelperTrait;

    public $layoutFile = '../Views/bootstrap.php';
    public $errors_view = '../Views/errors_view.php';
    public $errors_list;

    public function __construct($layoutFile = null)
    {
        if($layoutFile){
            $this->layoutFile = $layoutFile;
        }
    }

    public function renderLayout ($body)
    {
        ob_start();
        require $this->layoutFile;
        //ob_get_clean();
        return $body;
    }

    public function render ($viewName, array $params = [])
    {
        $viewFile = '..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.$viewName.'.php';
        extract($params);
        ob_start();
        if($this->errors_list){
            require $this->errors_view;
        }
        require $viewFile;
        $body = ob_get_clean();
        ob_end_clean();
        //if (defined(NO_LAYOUT)){
        //    return $body;
        //}
        return $this->renderLayout($body);
    }


}