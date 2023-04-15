<?php
class Controller {
    public function model($model_name) {
        if (file_exists(_DIR_ROOT.'/app/models/'.$model_name.'.php')) {
            require_once _DIR_ROOT.'/app/models/'.$model_name.'.php';

            if (class_exists($model_name)) {
                $model = new $model_name();
                return $model;
            }
        }

        return false;
    }
}
