<?php

require_once 'models/Product.php';

class ProductController {

    private $productModel;

    public function __construct() {

        $this->productModel = new Product();
    }

    public function dashboard() {

        $products = $this->productModel->getAll();

        include 'views/dashboard/index.php';
    }
}
?>