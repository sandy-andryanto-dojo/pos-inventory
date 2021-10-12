<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller as LaravelController;

class DashboardController extends LaravelController{
    
    public function index(){
        return view('main.dashboard.index');
    }
    
}

