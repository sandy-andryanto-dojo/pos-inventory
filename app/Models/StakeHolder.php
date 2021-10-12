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

class StakeHolder extends Model implements Auditable {
    
    use SoftDeletes, DataTable, \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'stakeholders';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'mobile',
        'postal_code',
        'fax_number',
        'address'
    ];

    public function selectData(){
        return [
            'stakeholders.name as stakeholder_name',
            'stakeholders.email as stakeholder_email',
            'stakeholders.email as stakeholder_phone',
            'stakeholders.address as stakeholder_address',
            'stakeholders.id as key_id'
        ];
    }

}
