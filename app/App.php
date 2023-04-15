<?php
class App {
    private $__controller;
    private $__action;
    private $__params;
    function __construct()
    {
        global $routes;

        if (!empty($routes['default_controller'])) {
            $this->__controller = $routes['default_controller'];
        }
        $this->__action = 'index';
        $this->__params = [];
        $this->handleUrl();
    }

    function getUrl() {
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }
        return $url;
    }

    function handleUrl() {
        $url = $this->getUrl();
        $urlArr = explode('/', $url);
        $urlArr = array_filter($urlArr);
        $urlArr = array_values($urlArr);

        //Xử lý controller
        if (!empty($urlArr[0])) {
            $this->__controller = ucfirst($urlArr[0]);
            unset($urlArr[0]);
        } else {
            $this->__controller = ucfirst($this->__controller);
        }

        if (file_exists('app/controllers/'.$this->__controller.'.php')) {
            require_once 'controllers/'.$this->__controller.'.php';

            //Kiểm tra nếu tồn tại class thì khởi tạo đối tượng
            if (class_exists($this->__controller)) {
                $this->__controller = new $this->__controller();
            } else {
                $this->loadError();
            }
        } else {
            $this->loadError();
        }

        //Xử lý action
        if (!empty($urlArr[1])) {
            $this->__action = strtolower($urlArr[1]);
            unset($urlArr[1]);
        } else {
            $this->__action = strtolower($this->__action);
        }

        //Xử lý params
        $this->__params = array_values($urlArr);

        //Kiểm tra nếu tồn tại action thì gọi action và truyền params vào
        if (method_exists($this->__controller,$this->__action)) {
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        } else {
            $this->loadError();
        }
    }

    function loadError($name = '404') {
        require_once 'errors/'.$name.'.php';
        exit();
    }
}