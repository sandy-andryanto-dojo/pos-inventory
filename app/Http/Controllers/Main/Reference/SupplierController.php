<?php

namespace App\Http\Controllers\Main\Reference;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends MainController{

    public function __construct(){
        $this->layout = "main.reference.supplier";
        $this->route = "suppliers";
        $this->title = "Supplier";
        $this->subtitle = "supplier management";
        $this->model = new Supplier;
        $this->dataTableModel = base64_encode(Supplier::class);
    }

    protected function createValidation(){
        return [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];
    }

    protected function updateValidation($id){
        return $this->createValidation();
    }

}