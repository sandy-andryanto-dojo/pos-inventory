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

class Supplier extends Model implements Auditable {

    use SoftDeletes,
        DataTable,
        \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'suppliers';
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
            'suppliers.name as supplier_name',
            'suppliers.email as supplier_email',
            'suppliers.email as supplier_phone',
            'suppliers.address as supplier_address',
            'suppliers.id as key_id'
        ];
    }

}
