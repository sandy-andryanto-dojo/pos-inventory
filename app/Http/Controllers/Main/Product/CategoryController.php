<?php

namespace App\Http\Controllers\Main\Product;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends MainController{

    public function __construct(){
        $this->layout = "main.product.category";
        $this->route = "categories";
        $this->title = "Category";
        $this->subtitle = "category management";
        $this->model = new Category;
        $this->dataTableModel = base64_encode(Category::class);
    }

    protected function createValidation(){
        return [
            'name' => 'required|unique:categories',
            'parent_id' => 'required',
        ];
    }

    protected function updateValidation($id){
        return [
            'name' => 'required|unique:categories,name,' . $id,
            'parent_id' => 'required',
        ];
    }

}