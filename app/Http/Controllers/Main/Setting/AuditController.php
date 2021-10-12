<?php

namespace App\Http\Controllers\Main\Setting;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Audit;

class AuditController extends MainController{

    public function __construct(){
        $this->layout = "main.setting.audit";
        $this->route = "audits";
        $this->title = "Audit";
        $this->subtitle = "audit log";
        $this->model = new Audit;
        $this->dataTableModel = base64_encode(Audit::class);
    }

    public function create(){
        return abort(404);  
    }

    public function store(Request $request){
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