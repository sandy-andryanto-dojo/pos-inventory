<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Configuration;

class SettingController extends BaseController{

    public function changeSkin(Request $request){
        $response = array();

        $theme = Configuration::where("slug", trim("app-theme"))->first();
        if(is_null($theme)){
            $theme = new Configuration;
            $theme->name = "app-theme";
            $theme->slug = "app-theme";
        }
        $theme->content = $request->get("theme");
        $theme->save();

        $box = Configuration::where("slug", trim("app-box"))->first();
        if(is_null($box)){
            $box = new Configuration;
            $box->name = "app-box";
            $box->slug = "app-box";
        }
        $box->content = $request->get("box");
        $box->save();

        $response = array("theme"=> $theme, "box"=> $box);
        return response()->json($response);
    }

}