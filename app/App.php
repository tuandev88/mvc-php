<?php
class App {
    private $__controller;
    private $__action;
    private $__params;
    function __construct()
    {
        $this->__controller = 'Home';
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

        if (!empty($urlArr[0])) {
            $this->__controller = ucfirst($urlArr[0]);

            if (file_exists('app/controllers/'.$this->__controller.'.php')) {
                require_once 'controllers/'.$this->__controller.'.php';
                $this->__controller = new $this->__controller();
            } else {
                echo 'Không tồn tại file '.'app/controllers/'.$this->__controller.'.php';
            }
        }
    }
}