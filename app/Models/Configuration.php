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

class Configuration extends Model implements Auditable {
    
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'configurations';
    protected $fillable = [
        'name',
        'slug',
        'content',
        'group',
        'type'
    ];

    public static function getBySlug($slug){
        $result = self::where("slug", trim($slug))->first();
        return !is_null($result) ? $result->content : $slug;
    }

}
