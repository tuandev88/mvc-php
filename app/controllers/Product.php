<?php
class Product extends Controller
{
    function index()
    {
        echo 'Danh sách sản phẩm';
    }

    public function list_product() {
        $product_model = $this->model('ProductModel');
        $data = $product_model->getProductList();
    }
}