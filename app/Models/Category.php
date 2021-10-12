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

class Category extends Model implements Auditable {

    use SoftDeletes,
        DataTable,
        \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'categories';
    protected $fillable = [
        'parent_id',
        'name',
        'description',
    ];

    public function Product() {
        return $this->hasMany(Product::class);
    }

    public function selectData(){
        return [
            'categories.name as category_name',
            'categories.description as category_description',
            'categories.id as key_id'
        ];
    }

    public function getParent(){
        $model = $this;
        return self::where("id", $model->parent_id)->first();
    }

    public static function getTreeCatgeories($model = null){
        $rows = self::orderBy("name", "ASC")->orderBy("parent_id", "ASC")->get()->toArray();
        $category = new self;
        $tree = $category->buildTree($rows);
        $category->printTree($tree, 0, isset($model->parent_id) ? $model->parent_id : null, $model);
    }

    private function buildTree(Array $data, $parent = 0) {
        $tree = array();
        foreach ($data as $d) {
            if ($d['parent_id'] == $parent) {
                $children = $this->buildTree($data, $d['id']);
                // set a trivial key
                if (!empty($children)) {
                    $d['_children'] = $children;
                }
                $tree[] = $d;
            }
        }
        return $tree;
    }

    private function printTree($tree, $r = 0, $p = null, $model = null) {
        foreach ($tree as $i => $t) {
            $selectedVal = '';
            $disabled = '';
            if(isset($model->parent_id)){
                $selectedVal = $model->parent_id == $t["id"] ? 'selected' : null;
            }
            if(isset($model->id)){
                $disabled = $model->id == $t["id"] ? 'disabled' : null;
            }
            $selectedVal .= $disabled;  
            $dash = (is_null($t['parent_id'])) ? '' : str_repeat('-', $r) .' ';
            printf("\t<option value='%d' ".$selectedVal.">%s%s</option>\n", $t['id'], $dash, $t['name']);
            if ($t['parent_id'] == $p) {
                // reset $r
                $r = 0;
            }
            if (isset($t['_children'])) {
                $this->printTree($t['_children'], ++$r, $t['parent_id'], $model);
            }
        }
    }

}
