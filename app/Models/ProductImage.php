<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DataTable;
use OwenIt\Auditing\Contracts\Auditable;
// Relations
use App\Models\Product;

class ProductImage extends Model implements Auditable {

    use DataTable,
        \OwenIt\Auditing\Auditable;

    protected $table = 'products_images';
    protected $fillable = [
        'product_id',
        'path',
        'is_primary'
    ];

    public function Product() {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function selectData(){
        return [
            'products_images.path as product_path',
            'products.sku as product_sku',
            'products.name as product_name',
            'products_images.is_primary as product_is_primary',
            'products_images.id as key_id'
        ];
    }

    public function dataTableQuery(){
        return self::where("products_images.id", "<>", 0)
            ->join("products", "products.id", "products_images.product_id")
        ;
    }

}
