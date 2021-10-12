<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller as LaravelController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProfileController extends LaravelController{
    
    public $data = array();

    public function index(){
        $this->data["model"] = \Auth::user();
        $this->data["route"] = 'profiles.store';
        return view('main.profile.index', $this->data);
    }

    public function store(Request $request){
        $user = \Auth::user();
        $id = $user->id;
        $rules = array(
            'username' => 'required|alpha_dash|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
        );
        if($request->get('phone')) $rules["phone"] = 'required|regex:/^[0-9]+$/|unique:users,phone,'.$id;
        if($request->get('mobile')) $rules["mobile"] = 'required|regex:/^[0-9]+$/|unique:users,mobile,'.$id;
        if($request->get('password')) $rules["password"] = 'required|string|min:6';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{
            $user->username = $request->get("username");
            $user->email = $request->get("email");
            $user->first_name = $request->get("first_name");
            $user->last_name = $request->get("last_name");
            $user->gender = $request->get("gender");
            $user->postal_code = $request->get("postal_code");
            $user->fax_number = $request->get("fax_number");
            $user->birth_place = $request->get("birth_place");
            $user->birth_date = $request->get("birth_date");
            $user->address = $request->get("address");
            if($request->get("password")) $user->password = bcrypt($request->get('password'));
            if($request->get("phone")) $user->phone = $request->get("phone");
            if($request->get("mobile")) $user->mobile = $request->get("mobile");
            $user->save();
            return redirect()->route("profiles.index")->with('success', 'Success: You have modified profiles! ');
        }
    }

    public function edit($id){
        return abort(404);  
    }

    public function show($id){
        return abort(404);  
    }

    public function update($id, Request $request){
        return abort(404);  
    }

    public function destroy ($id){
        return abort(404);  
    }
    
}

