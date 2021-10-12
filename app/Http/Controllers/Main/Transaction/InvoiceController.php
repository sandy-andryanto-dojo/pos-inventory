<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Main\Transaction;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Stakeholder;
use App\Models\Bank;

class InvoiceController extends BaseController{

    public function previewLoader(){
        return null;
    }

    public function preview($id, $collections){
        $transaction = Transaction::where("id", $id)->first();
        if(is_null($transaction)){
            return abort(404);  
        }
        $data = json_decode(base64_decode($collections));
        $data->transaction->is_purchased = $transaction->is_purchased;
        $data->transaction->record_date = $transaction->created_at;
        $data->transaction->notes = $transaction->notes;
        $data->transaction->user_id = $transaction->user_id;

        if(isset($data->transaction->customer_id)){
            $data->customer = Customer::where("id", $data->transaction->customer_id)->first();
        }else{
            $data->customer = null;
        }

        if(isset($data->transaction->supplier_id)){
            $data->supplier = Supplier::where("id", $data->transaction->supplier_id)->first();
        }else{
            $data->supplier = null;
        }

        if(isset($data->transaction->stakeholder_id)){
            $data->stakeholder = Stakeholder::where("id", $data->transaction->stakeholder_id)->first();
        }else{
            $data->stakeholder = null;
        }

        if(isset($data->transaction->bank_id)){
            $data->bank = Bank::where("id", $data->transaction->bank_id)->first();
        }else{
            $data->bank = null;
        }

        if((int) $transaction->type == 1){
            return view("main.transaction.sale.invoice", ["data" => $data]);
        }else if((int) $transaction->type == 2){
            return view("main.transaction.purchase.invoice", ["data" => $data]);
        }else if((int) $transaction->type == 3){
            return view("main.transaction.fee.invoice", ["data" => $data]);
        }else{
            return abort(404);  
        }
        
    }


}