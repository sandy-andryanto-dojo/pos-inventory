<?php

namespace App\Http\Controllers\Main\Product;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Group;

class ItemController extends MainController{

    public function __construct(){
        $this->layout = "main.product.item";
        $this->route = "items";
        $this->title = "Item";
        $this->subtitle = "item management";
        $this->model = new Product;
        $this->dataTableModel = base64_encode(Product::class);
    }

    public function create(){
       $this->data["brands"] = Brand::orderBy("name", "ASC")->get();
       $this->data["groups"] = Group::orderBy("name", "ASC")->get();
       return parent::create();
    }

    public function edit($id){
        $this->data["brands"] = Brand::orderBy("name", "ASC")->get();
        $this->data["groups"] = Group::orderBy("name", "ASC")->get();
        return parent::edit($id);
     }

    protected function createValidation(){
        return [
            'name' => 'required|unique:products',
            'sku' => 'required|unique:products',
        ];
    }

    protected function updateValidation($id){
        return [
            'name' => 'required|unique:products,name,' . $id,
            'sku' => 'required|unique:products,sku,' . $id,
        ];
    }

}