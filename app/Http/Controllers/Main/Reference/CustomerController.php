<?php

namespace App\Http\Controllers\Main\Reference;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends MainController{

    public function __construct(){
        $this->layout = "main.reference.customer";
        $this->route = "customers";
        $this->title = "Customer";
        $this->subtitle = "customer management";
        $this->model = new Customer;
        $this->dataTableModel = base64_encode(Customer::class);
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