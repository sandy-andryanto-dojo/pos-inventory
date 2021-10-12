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

class Brand extends Model implements Auditable{
    
    use SoftDeletes, \OwenIt\Auditing\Auditable, DataTable;

    protected $dates = ['deleted_at'];
    protected $table = 'brands';
    protected $fillable = [
        'name',
        'description',
    ];
    
    public function Product() {
        return $this->hasMany(Product::class);
    }

    public function selectData(){
        return [
            'brands.name as brand_name',
            'brands.description as brand_description',
            'brands.id as key_id'
        ];
    }

}
