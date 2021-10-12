<?php

namespace App\Http\Controllers\Main\Transaction;

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Stakeholder;

class FeeController extends MainController{

    const TYPE = 3;
    const CODE = "TFEE";

    public function __construct(){
        $this->layout = "main.transaction.fee";
        $this->route = "transaction_fees";
        $this->title = "Fee";
        $this->subtitle = "fee invoice management";
        $this->model = new Transaction;
        $this->dataTableModel = base64_encode(Transaction::class);
    }

    protected function createValidation(){
        return [
            'stakeholder_id' => 'required',
            'invoice_date' => 'required',
            'invoice_number' => 'required|unique:transactions',
            'grandtotal' => 'required',
        ];
    }

    protected function updateValidation($id){
        return [
            'stakeholder_id' => 'required',
            'invoice_date' => 'required',
            'invoice_number' => 'required|unique:transactions,invoice_number,' . $id,
            'grandtotal' => 'required',
        ];
    }

    public function create(){
        $model = array(
            "invoice_number"=> Transaction::createInvoiceNumber(self::TYPE, self::CODE)
        );
        $this->data["stakeholders"] = Stakeholder::orderBy("name", "ASC")->get();
        $this->data["model"] = (object) $model;
        $this->data["title"] = $this->title;
        $this->data["subtitle"] = $this->subtitle;
        $this->data["route"] = $this->route;
        return $this->__render__page($this->layout.".form", $this->data);
     }
 
    public function edit($id){
         $this->data["stakeholders"] = Stakeholder::orderBy("name", "ASC")->get();
         return parent::edit($id);
    }

    public function store(Request $request){
        $rules = $this->createValidation();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{
            $post = $request->all();
            $post["invoice_number"] = Transaction::createInvoiceNumber(self::TYPE, self::CODE);
            $data = $this->model->create($post);
            $id = $data->id;
            return redirect()->route($this->route.".show", ["id"=>$id])->with('success', self::SUCCESS_MESSAGE_CREATED);
        }
    }

    
}