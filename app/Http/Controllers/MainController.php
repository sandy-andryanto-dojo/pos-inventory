<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as LaravelController;
use App\Traits\Authorizable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class MainController extends LaravelController{

    use Authorizable;

    protected $layout, $model, $route, $dataTableModel, $title = "Title", $subtitle = "Subtitle";

    public $data = array();

    const SUCCESS_MESSAGE_CREATED = "Success: You have created record!";
    const SUCCESS_MESSAGE_UPDATED = "Success: You have modified record!";
    const SUCCESS_MESSAGE_DELETED = "Success: You have deleted record!";
    const FAILED_MESSAGE_CREATED =  "Failed: You have not created record!";
    const FAILED_MESSAGE_UPDATED = "Failed: You have not modified record!";
    const FAILED_MESSAGE_DELETED = "Failed: You have not modified record!";

    public function index(){
        $this->data["dataTableModel"] = $this->dataTableModel;
        $this->data["model"] = $this->model;
        $this->data["title"] = $this->title;
        $this->data["subtitle"] = $this->subtitle;
        $this->data["route"] = $this->route;
        return $this->__render__page($this->layout.".index", $this->data);
    }

    public function create(){
        $this->data["title"] = $this->title;
        $this->data["subtitle"] = $this->subtitle;
        $this->data["model"] = $this->model;
        $this->data["route"] = $this->route;
        return $this->__render__page($this->layout.".form", $this->data);
    }

    public function edit($id){
        $model = $this->model->where("id", $id)->first();
        if(is_null($model)){
            return abort(404);  
        }
        $this->data["title"] = $this->title;
        $this->data["subtitle"] = $this->subtitle;
        $this->data["model"] = $model;
        $this->data["route"] = $this->route;
        return $this->__render__page($this->layout.".form", $this->data);
    }

    public function store(Request $request){
        $rules = $this->createValidation();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{
            $post = $request->all();
            $data = $this->model->create($post);
            $id = $data->id;
            return redirect()->route($this->route.".show", ["id"=>$id])->with('success', self::SUCCESS_MESSAGE_CREATED);
        }
    }

    public function show($id){
        $model = $this->model->where("id", $id)->first();
        if(is_null($model)){
            return abort(404);  
        }
        $this->data["title"] = $this->title;
        $this->data["subtitle"] = $this->subtitle;
        $this->data["model"] = $model;
        $this->data["route"] = $this->route;
        return $this->__render__page($this->layout.".show", $this->data);
    }

    public function update($id, Request $request){
        $rules = $this->updateValidation($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{
            $post = $request->all();
            $data = $this->model->where("id", $id)->first();
            $data->fill($post);
			$data->save();
            return redirect()->route($this->route.".show", ["id"=>$id])->with('success', self::SUCCESS_MESSAGE_UPDATED);
        }
    }

    public function destroy($id){
        $model = $this->model->where("id", $id)->first();
        if(is_null($model)){
            return abort(404);  
        }

        $this->model->where("id", $id)->delete();
        return redirect()->route($this->route.".index")->with('success', self::SUCCESS_MESSAGE_DELETED);
    }

    protected function __render__page($view, array $items){
        $user = \Auth::user();
        $permissions = array(
            "can_view"=> $user->can("view_".$this->route),
            "can_create"=> $user->can("add_".$this->route),
            "can_edit"=> $user->can("edit_".$this->route),
            "can_delete"=> $user->can("delete_".$this->route)
        );
        $items["permissions"] = $permissions;
        return view($view, $items);
    }

    protected function createValidation(){
        return array();
    }

    protected function updateValidation($id){
        return array();
    }


}