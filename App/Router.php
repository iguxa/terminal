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
        $this->routes = include ($routesPath);
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
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            if(is_string($path)){
                if (preg_match("~$uriPattern~", $uri)){
                    $this->try_it($uriPattern,$path,$uri);
                    break;
                }
            }elseif(is_array($path)){
                foreach ($path['routes'] as $uriMiddle => $pathMiddle){
                    if (preg_match("~$uriMiddle~", $uri)){
                        if(Middleware::getMiddleware($path['middleware'])->check()){
                            $this->try_it($uriMiddle,$pathMiddle,$uri);
                            break;
                        }
                        else{
                             Exeption::access_denied();
                             break;
                        }
                    }
                }

            }
        }

    }
    public function try_it($uriMiddle,$pathMiddle,$uri)
    {
        //if()
        $internalRoute = preg_replace("~$uriMiddle~", $pathMiddle, $uri);
        $segments = explode('/', $internalRoute);
        $controllerName = array_shift($segments).'Controller';
        $controllerName = 'Controllers\\'.ucfirst($controllerName);
        $actionName = 'action'.ucfirst(array_shift($segments));
        $parametrs = $segments;
        $controllerObject = new $controllerName;
        if(!method_exists($controllerObject,$actionName)){
            return Exeption::getInstance()->error404();
        }
        call_user_func_array(array($controllerObject,$actionName), $parametrs);
    }
}