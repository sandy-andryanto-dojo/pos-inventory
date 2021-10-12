<?php

namespace App\Http\Controllers\Main\Setting;

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends MainController{

    public function __construct(){
        $this->layout = "main.setting.role";
        $this->route = "roles";
        $this->title = "Role & Permission";
        $this->subtitle = "role & permission management";
        $this->model = new Role;
        $this->dataTableModel = base64_encode(Role::class);
    }

    public function create(){
        $this->data["list_actions"] = array("view","add","edit","delete");
        $this->data["list_permissions"] = Permission::all();
        $this->data["title"] = $this->title;
        $this->data["subtitle"] = $this->subtitle;
        $this->data["model"] = $this->model;
        $this->data["route"] = $this->route;
        return $this->__render__page($this->layout.".form", $this->data);
    }

    public function show($id){
        $model = $this->model->where("id", $id)->where("name", "!=", trim("Admin"))->first();
        if(is_null($model)){
            return abort(404);  
        }
        $this->data["list_actions"] = array("view","add","edit","delete");
        $this->data["list_permissions"] = Permission::all();
        $this->data["title"] = $this->title;
        $this->data["subtitle"] = $this->subtitle;
        $this->data["model"] = $model;
        $this->data["route"] = $this->route;
        return $this->__render__page($this->layout.".show", $this->data);
    }

    public function edit($id){
        $model = $this->model->where("id", $id)->where("name", "!=", trim("Admin"))->first();
        if(is_null($model)){
            return abort(404);  
        }
        $this->data["list_actions"] = array("view","add","edit","delete");
        $this->data["list_permissions"] = Permission::all();      
        $this->data["title"] = $this->title;
        $this->data["subtitle"] = $this->subtitle;
        $this->data["model"] = $model;
        $this->data["route"] = $this->route;
        return $this->__render__page($this->layout.".form", $this->data);
    }

    public function destroy($id){
        $model = $this->model->where("id", $id)->where("name", "!=", trim("Admin"))->first();
        if(is_null($model)){
            return abort(404);  
        }

        $this->model->where("id", $id)->delete();
        return redirect()->route($this->route.".index")->with('success', self::SUCCESS_MESSAGE_DELETED);
    }

    public function store(Request $request){
        $rules = $this->createValidation();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{
            $role = Role::create(["name"=> $request->get("name"), "description"=> $request->get("description")]);
            $permissions = $request->get('permissions', []);
            $role->syncPermissions($permissions);
            $id = $role->id;
            return redirect()->route($this->route.".show", ["id"=>$id])->with('success', self::SUCCESS_MESSAGE_CREATED);
        }
    }

    public function update($id, Request $request){
        $rules = $this->updateValidation($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{
            $role = Role::findOrfail($id);
            $role->name = $request->get("name");
            $role->description = $request->get("description");
            $permissions = $request->get('permissions', []);
            $role->save();
            $role->syncPermissions($permissions);
            return redirect()->route($this->route.".show", ["id"=>$id])->with('success', self::SUCCESS_MESSAGE_UPDATED);
        }
    }

    protected function createValidation(){
        return [
            'name' => 'required|unique:roles',
            'permissions' => 'required|min:1',
        ];
    }

    protected function updateValidation($id){
        return [
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'required|min:1',
        ];
    }

}