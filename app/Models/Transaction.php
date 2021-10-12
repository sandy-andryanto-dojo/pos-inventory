<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\DataTable;
use DB;
// Relations
use App\Models\Bank;
use App\Models\User;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\StakeHolder;
use App\Models\TransactionDetail;

class Transaction extends Model implements Auditable {

    use SoftDeletes,
        DataTable,
        \OwenIt\Auditing\Auditable;

    private $type = 0;    
    protected $dates = ['deleted_at'];
    protected $table = 'transactions';
    protected $fillable = [
        'bank_id',
        'user_id',
        'customer_id',
        'supplier_id',
        'stakeholder_id',
        'is_purchased',
        'type',
        'creditcard_number',
        'invoice_date',
        'invoice_number',
        'total_items',
        'subtotal',
        'tax',
        'discount',
        'grandtotal',
        'cash',
        'change',
        'notes',
        'description',
    ];

    public function Bank() {
        return $this->belongsTo(Bank::class, "bank_id");
    }

    public function User() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function Casheir() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function Customer() {
        return $this->belongsTo(Customer::class, "customer_id");
    }

    public function Supplier() {
        return $this->belongsTo(Supplier::class, "supplier_id");
    }

    public function StakeHolder(){
        return $this->belongsTo(StakeHolder::class, "stakeholder_id");
    }
    
    public function TransactionDetail() {
        return $this->hasMany(TransactionDetail::class);
    }

  

    public static function createInvoiceNumber($type, $code){
        $sql = "SELECT MAX(invoice_number) as max_number FROM transactions WHERE type = ".$type." AND invoice_date <=  DATE(now())";
        $data = DB::select($sql);
        if(!is_null($data) && isset($data[0]->max_number)){
            $arr = explode(".", $data[0]->max_number);
            $val = (int) $arr[2] + 1;
            $digit = 5;
            $i_number = strlen($val);
            for ($i = $digit; $i > $i_number; $i--) {
                $val = "0" . $val;
            }
            return $code.".".date("Ymd").".".$val;
        }
        return $code.".".date("Ymd").".00001";
    }

    public function selectData(){
        return [
            'transactions.created_at as created_at',
            'transactions.invoice_number as invoice_number',
            'users.username as username',
            'customers.name as customer_name',
            'suppliers.name as supplier_name',
            'stakeholders.name as stakeholder_name',
            'transactions.total_items as total_items',
            'transactions.subtotal as subtotal',
            'transactions.tax as tax',
            'transactions.discount as discount',
            'transactions.grandtotal as grandtotal',
            'transactions.is_purchased as is_purchased',
            'transactions.id as key_id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'transactions.notes as t_notes',
            'transactions.description as t_description',
        ];
    }

     public function dataTableQuery(){
        $t = $this->getType();
        return self::where("transactions.id", "<>", 0)
            ->where("transactions.type", $t)
            ->leftJoin("users", "users.id", "transactions.user_id")
            ->leftJoin("customers", "customers.id", "transactions.customer_id")
            ->leftJoin("suppliers", "suppliers.id", "transactions.supplier_id")
            ->leftJoin("stakeholders", "stakeholders.id", "transactions.stakeholder_id")
        ;
    }

    public static function saveInvoice($type, $id, $inv){

        $invoice = json_decode(base64_decode($inv));
        TransactionDetail::where("transaction_id", $id)->delete();

        $transaction = $invoice->transaction;
        $details = $invoice->details;

        $tr = self::where("id", $id)->first();
        $tr->subtotal = $transaction->subtotal;
        $tr->discount = $transaction->discount;
        $tr->tax = $transaction->tax;
        $tr->notes = isset($transaction->notes) ? $transaction->notes : null;
        $tr->grandtotal = $transaction->grandtotal;
        if(is_null($transaction->bank_id)){
            $tr->cash = $transaction->cash;
            $tr->change = $transaction->change;
            $tr->bank_id = null;
            $tr->creditcard_number = null;
        }else{
            $tr->cash = 0;
            $tr->change = 0;
            $tr->bank_id = $transaction->bank_id;
            $tr->creditcard_number = $transaction->creditcard_number;
        }

        if((int) $type == 1){
            if(isset($transaction->customer_id)){
                $tr->customer_id = $transaction->customer_id;
                $tr->supplier_id = null;
                $tr->stakeholder_id =  null;
            }else{
                $tr->customer_id = null;
                $tr->supplier_id = null;
                $tr->stakeholder_id =  null;
            }
        }

        if((int) $type == 2){
            if(isset($transaction->supplier_id)){
                $tr->customer_id = null;
                $tr->supplier_id = $transaction->supplier_id;
                $tr->stakeholder_id =  null;
            }else{
                $tr->customer_id = null;
                $tr->supplier_id = null;
                $tr->stakeholder_id =  null;
            }
        }

        if((int) $type == 3){
            if(isset($transaction->stakeholder_id)){
                $tr->customer_id = null;
                $tr->supplier_id = null;
                $tr->stakeholder_id =  $transaction->stakeholder_id;
            }else{
                $tr->customer_id = null;
                $tr->supplier_id = null;
                $tr->stakeholder_id =  null;
            }
        }

        $tr->save();
        
        $total_items = 0;
        if(count($details) > 0){
            if((int) $type == 1 || (int) $type == 2){
                foreach($details as $row){
                    TransactionDetail::create([
                        'transaction_id'=> $id,
                        'product_id'=> $row->product_id,
                        'price'=> $row->price,
                        'qty'=> $row->qty,
                        'total'=> $row->total
                    ]);
                    $total_items += $row->qty;
                    // Sales
                    if((int) $type == 1){
                        $pr = Product::where("id", $row->product_id)->first();
                        $pr->stock = $pr->stock - $row->qty;
                        $pr->save();
                    }
                    // Purchases
                    if((int) $type == 2){
                        $pr = Product::where("id", $row->product_id)->first();
                        $pr->stock = $pr->stock + $row->qty;
                        $pr->save();
                    }
                }
            }else{
                // Fee
            }
        }

        return self::where("id", $id)->update(["total_items" => $total_items, "is_purchased" => 1]);
    }


    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
