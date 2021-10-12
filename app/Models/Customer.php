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
// Relations
use App\Models\Transaction;

class Customer extends Model implements Auditable {

    use SoftDeletes,
        DataTable,
        \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'mobile',
        'postal_code',
        'fax_number',
        'address'
    ];

    public function Transaction() {
        return $this->hasMany(Transaction::class);
    }

    public function selectData(){
        return [
            'customers.name as customer_name',
            'customers.email as customer_email',
            'customers.email as customer_phone',
            'customers.address as customer_address',
            'customers.id as key_id'
        ];
    }

}
