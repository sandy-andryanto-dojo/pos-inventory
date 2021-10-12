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

class Bank extends Model implements Auditable {

    use SoftDeletes,
        DataTable,
        \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'banks';
    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    public function Transaction() {
        return $this->hasMany(Transaction::class);
    }

    public function selectData(){
        return [
            'banks.code as bank_code',
            'banks.name as bank_name',
            'banks.description as bank_description',
            'banks.id as key_id'
        ];
    }

}
