<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DataTable;

class Audit extends Model{

    use DataTable;
    
    protected $table = 'audits';
    protected $fillable = [
        'user_id',
        'event',
        'auditable_id',
        'auditable_type',
        'old_values',
        'new_values',
        'url',
        'ip_address',
        'user_agent',
        'tags'
    ];

    public function selectData(){
        return [
            "audits.created_at",
            "username",
            "event",
            "url",
            "ip_address",
            "user_agent",
        ];
    }

    public function dataTableQuery(){
        return self::where($this->table.".id", "<>", 0)->join("users", "users.id", "=", "audits.user_id");
    }
    
}
