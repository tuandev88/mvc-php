<?php
class HomeModel {
    protected $_table = 'products';

    function getList() {
        $data = [
            "Item 1",
            "Item 2",
            "Item 3"
        ];

        return $data;
    }

    function getDetail($id) {
        $data = [
            "Item 1",
            "Item 2",
            "Item 3"
        ];

        return $data[$id];
    }
}
