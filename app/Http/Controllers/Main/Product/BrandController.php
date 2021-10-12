<?php

namespace App\Http\Controllers\Main\Product;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends MainController{

    public function __construct(){
        $this->layout = "main.product.brand";
        $this->route = "brands";
        $this->title = "Brand";
        $this->subtitle = "brand management";
        $this->model = new Brand;
        $this->dataTableModel = base64_encode(Brand::class);
    }

    protected function createValidation(){
        return [
            'name' => 'required|unique:brands',
        ];
    }

    protected function updateValidation($id){
        return [
            'name' => 'required|unique:brands,name,' . $id,
        ];
    }

}