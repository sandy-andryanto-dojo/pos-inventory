<?php

namespace App\Http\Controllers\Main\Reference;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\StakeHolder;

class StakeHolderController extends MainController{

    public function __construct(){
        $this->layout = "main.reference.stakeholder";
        $this->route = "stakeholders";
        $this->title = "StakeHolder";
        $this->subtitle = "stakeholder management";
        $this->model = new StakeHolder;
        $this->dataTableModel = base64_encode(StakeHolder::class);
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