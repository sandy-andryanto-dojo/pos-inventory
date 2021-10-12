<?php

namespace App\Http\Controllers\Main\Transaction;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Group;
use App\Models\Bank;


class SaleController extends MainController{

    const TYPE = 1;
    const CODE = "TRSL";

    public function __construct(){
        $this->layout = "main.transaction.sale";
        $this->route = "transaction_sales";
        $this->title = "Sale";
        $this->subtitle = "sale invoice management";
        $this->model = new Transaction;
        $this->dataTableModel = base64_encode(Transaction::class);
    }

    public function create(){
        $invoice_number = Transaction::createInvoiceNumber(self::TYPE, self::CODE);
        $invoice_date = date("Y-m-d");
        $user_id = \Auth::user()->id;
        $data = array(
            'user_id'=> $user_id,
            'is_purchased'=> 0,
            'type'=> self::TYPE,
            'invoice_date'=> $invoice_date,
            'invoice_number'=> $invoice_number,
            'total_items'=> 0,
            'subtotal'=> 0,
            'tax'=> 0,
            'discount'=> 0,
            'grandtotal'=> 0,
            'cash'=> 0,
            'change'=> 0
        );
        $transaction = Transaction::create($data);
        return redirect()->route($this->route.".edit", ["id"=>$transaction->id]);
    }

    public function edit($id){

        $model = $this->model->where("id", $id)
            ->where("type", self::TYPE)
            ->where("is_purchased", 0)
            ->first();

        if(is_null($model)){
            return abort(404);  
        }

        $this->data["title"] = $this->title;
        $this->data["subtitle"] = $this->subtitle;
        $this->data["model"] = $model;
        $this->data["banks"] = Bank::orderBy("name", "ASC")->get();
        $this->data["customers"] = Customer::orderBy("name", "ASC")->get();
        $this->data["brands"] = Brand::orderBy("name", "ASC")->get();
        $this->data["groups"] = Group::orderBy("name", "ASC")->get();
        $this->data["route"] = $this->route;
        return $this->__render__page($this->layout.".form", $this->data);
    }

    public function show($id){
        $model = $this->model->where("id", $id)->first();
        if(is_null($model)){
            return abort(404);  
        }

        $details = TransactionDetail::where("transaction_id", $id)->get();

        $collections = array();
        $collections["transaction"] = $model;
        $collections["details"] = array();
        
        if(count($details) > 0){
            $temp = array();
            foreach($details as $row){
                $temp[] = array(
                    "product_id"=> $row->product_id,
                    "product_sku"=> $row->Product->sku,
                    "product_name"=>  $row->Product->name,
                    "price"=> $row->price,
                    "qty"=> $row->qty,
                    "total"=> $row->total
                );
            }
            $collections["details"] = $temp;
        }
        
        $this->data["title"] = $this->title;
        $this->data["subtitle"] = $this->subtitle;
        $this->data["model"] = $model;
        $this->data["details"] = $details;
        $this->data["collections"] = base64_encode(json_encode($collections));
        $this->data["route"] = $this->route;
        return $this->__render__page($this->layout.".show", $this->data);
    }
   

    public function update($id, Request $request){
        if($request->get("data-invoice")){
            $updated = Transaction::saveInvoice(self::TYPE, $id, $request->get("data-invoice"));
            return redirect()->route($this->route.".show", ["id"=>$id])->with('success', 'You transaction have been successful!.');
        }else{
            return abort(404);  
        }
    }

}