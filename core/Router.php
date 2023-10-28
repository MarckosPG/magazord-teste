<?php

namespace Core;

class Router {

    private $controller = "HomeController";
    private $method = "index";
    private $param = [];

    public function __construct () {
        $router = $this->url();

        if (file_exists('./src/Controller/' . ucfirst($router[0]) . 'Controller.php')) {
            $this->controller = $router[0] . 'Controller';
            unset($router[0]);
        }

        $class = "\\src\\Controller\\" . ucfirst($this->controller);

        $object = new $class;

        if (isset($router[1]) && method_exists($class, $router[1])) {
            $this->method = $router[1];
            unset($router[1]);
        }

        $this->param = $router ? array_values($router) : [];

        call_user_func_array([$object, $this->method], $this->param);
    }

    public function url () {
        $url = explode("/", ltrim($_SERVER['REQUEST_URI'], "/"));
        return $url;
    }

}