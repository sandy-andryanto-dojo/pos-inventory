<?php

namespace App\Http\Controllers\Main\Setting;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Configuration;

class SettingController extends MainController{

    public function __construct(){
        $this->layout = "main.setting.config";
        $this->route = "settings";
        $this->title = "Setting Application";
        $this->subtitle = "setting management";
        $this->model = new Configuration;
        $this->dataTableModel = base64_encode(Configuration::class);
    }

    public function index(){
        $this->data["dataTableModel"] = $this->dataTableModel;
        $this->data["model"] = $this->model;
        $this->data["title"] = $this->title;
        $this->data["subtitle"] = $this->subtitle;
        $this->data["route"] = $this->route;
        $this->data["currencies"] = \Config::get('currency.list');
        $this->data["timezones"] = \Config::get('timezone.list');
        return $this->__render__page($this->layout.".index", $this->data);
    }

    public function store(Request $request){
        $data = $request->all();
        foreach($data as $key => $row){
            $slug = $key;
            $content = $row;
            if($slug != "_token" && $slug != "company-logo"){
                $setting = Configuration::where("slug", trim($slug))->first();
                if(is_null($setting)){
                    Configuration::create([
                        "name"=> $slug,
                        "slug"=> $slug,
                        "content"=> $content
                    ]);
                }else{
                    $setting->content = $row;
                    $setting->save();
                }
            }
        }

        if($request->file('company-logo')){

            $image = null;
            $file = $request->file('company-logo');
            $imageName = md5(rand(0,1000)."".time()).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $file->move($destinationPath, $imageName);
            $image = 'uploads/'.$imageName;

            $logo = Configuration::where("slug", trim('company-logo'))->first();
            if(is_null($logo)){
                Configuration::create([
                    "name"=> "company-logo",
                    "slug"=> "company-logo",
                    "content"=> $image
                ]);
            }else{
                if(file_exists(public_path($logo->content))){
                    unlink(public_path($logo->content));
                }
                $logo->content = $image;
                $logo->save();
            }

        }

        return redirect()->route($this->route.".index")->with('success', self::SUCCESS_MESSAGE_UPDATED);
    }

    public function create(){
        return abort(404);  
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

    public function destroy($id){
        return abort(404);  
    }

}