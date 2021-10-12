<?php

namespace App\Http\Controllers\Main\Reference;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Bank;

class BankController extends MainController{

    public function __construct(){
        $this->layout = "main.reference.bank";
        $this->route = "banks";
        $this->title = "Bank";
        $this->subtitle = "bank management";
        $this->model = new Bank;
        $this->dataTableModel = base64_encode(Bank::class);
    }

    protected function createValidation(){
        return [
            'code' => 'required|unique:banks',
            'name' => 'required|unique:banks',
        ];
    }

    protected function updateValidation($id){
        return [
            'code' => 'required|unique:banks,code,' . $id,
            'name' => 'required|unique:banks,name,' . $id,
        ];
    }

}