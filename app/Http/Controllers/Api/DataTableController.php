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
use App\Models\Transaction;

class DataTableController extends BaseController{

    public function getDataTable($model, Request $request){
        $modelClass = str_replace("/", '\\', base64_decode($model));
        $m = new $modelClass;
        $result = $m->dataTable($request->all());
        return response()->json($result);
    }

    public function getTransactionDataTable($type, Request $request){
        $model = new Transaction;
        $model->setType($type);
        $result = $model->dataTable($request->all());
        return response()->json($result);
    }

    public function removeDataTable(Request $request){
        $model = $request->get("model");
        $id = $request->get("id");
        $modelClass = str_replace("/", '\\', base64_decode($model));
        $m = new $modelClass;
        $result = $m->findOrfail($id)->delete();
        return response()->json($result);
    }

}