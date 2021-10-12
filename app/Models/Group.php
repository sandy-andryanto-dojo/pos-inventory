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
use App\Models\Product;

class Group extends  Model implements Auditable {
    
    use SoftDeletes, DataTable, \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'groups';
    protected $fillable = [
        'name',
        'description',
    ];
    
    public function Product() {
        return $this->hasMany(Product::class);
    }

    public function selectData(){
        return [
            'groups.name as group_name',
            'groups.description as group_description',
            'groups.id as key_id'
        ];
    }

}
