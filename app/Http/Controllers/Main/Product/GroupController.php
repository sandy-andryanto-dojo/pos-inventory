<?php

namespace App\Http\Controllers\Main\Product;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends MainController{

    public function __construct(){
        $this->layout = "main.product.group";
        $this->route = "groups";
        $this->title = "Group";
        $this->subtitle = "group management";
        $this->model = new Group;
        $this->dataTableModel = base64_encode(Group::class);
    }

    protected function createValidation(){
        return [
            'name' => 'required|unique:groups',
        ];
    }

    protected function updateValidation($id){
        return [
            'name' => 'required|unique:groups,name,' . $id,
        ];
    }

}