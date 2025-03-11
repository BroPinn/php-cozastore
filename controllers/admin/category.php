<?php

require_once __DIR__ . '/../../models/CategoryModel.php';

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new CategoryModel();
    }

    public function index() {
        // Load the category view
        require_once __DIR__ . '/../../views/admin/category.view.php';
    }
}

$categoryController = new CategoryController();
$categoryController->index();