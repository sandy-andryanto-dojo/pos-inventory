<?php

namespace App\Models;

use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\DataTable;


class Role extends \Spatie\Permission\Models\Role implements Auditable { 

    use \OwenIt\Auditing\Auditable, DataTable;

    protected $table = 'roles';

    public function selectData(){
        return [
            'roles.name as role_name',
            'roles.description as role_description',
            'roles.id as key_id'
        ];
    }

    public function dataTableQuery(){
        return self::where($this->table.".name", "!=", trim("Admin"));
    }
    
}