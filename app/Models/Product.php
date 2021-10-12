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
use App\Models\Category;
use App\Models\Group;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\TransactionDetail;

class Product extends Model implements Auditable {

    use SoftDeletes,
        DataTable,
        \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'group_id',
        'brand_id',
        'sku',
        'name',
        'price_profit',
        'price_purchase',
        'price_sale',
        'stock',
        'date_expired',
        'notes',
        'description'
    ];

    public function Brand() {
        return $this->belongsTo(Brand::class, "brand_id");
    }

    public function Category() {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function Group() {
        return $this->belongsTo(Group::class, "group_id");
    }

    public function ProductImage() {
        return $this->hasMany(ProductImage::class);
    }

    public function TransactionDetail() {
        return $this->hasMany(TransactionDetail::class);
    }

    public function selectData(){
        return [
            'products.sku as product_sku',
            'products.name as product_name',
            'brands.name as brand_name',
            'categories.name as category_name',
            'groups.name as group_name',
            'products.stock as product_stock',
            'products.price_purchase as product_price_purchase',
            'products.price_sale as product_price_sale',
            'products.id as key_id'
        ];
    }

     public function dataTableQuery(){
        return self::where("products.id", "<>", 0)
            ->leftJoin("categories", "categories.id", "products.category_id")
            ->leftJoin("groups", "groups.id", "products.group_id")
            ->leftJoin("brands", "brands.id", "products.brand_id")
        ;
    }

}
