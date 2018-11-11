<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 09.11.18
 * Time: 1:00
 */

namespace App;

class Router
{
    private $routes;
    public function __construct()
    {
        $routesPath = '../config/routes.php';
        $this -> routes = include ($routesPath);
    }
    //request uri
    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    public function run()
    {
        $uri = $this -> getURI();
        foreach ($this ->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)){
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments).'Controller';
                $controllerName =  'Controllers\\'.ucfirst($controllerName);
                $actionName = 'action'.ucfirst(array_shift($segments));
                $parametrs = $segments;
                //print_r(file_exists($controllerFile));
                //exit();
                $controllerObject = new $controllerName;
                //echo $controllerObject;
                //exit();
                //$result = $controllerObject -> $actionName($parametrs);
                $result = call_user_func_array(array($controllerObject,$actionName), $parametrs);
                if ($result != null){
                    break;
                }
            }
        }

    }


}