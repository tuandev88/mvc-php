<?php

class Home extends Controller
{
    public $model_object;
    function __construct()
    {
        $this->model_object = $this->model('HomeModel');
    }

    function index()
    {
        //echo 'Trang chủ';
        $data = $this->model_object->getList();

        $detail = $this->model_object->getDetail(1);
    }
}