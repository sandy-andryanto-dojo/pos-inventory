<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use App\Notifications\ResetPassword;
use App\Traits\DataTable;
// Relations
use App\Models\Role;
use App\Models\Transaction;

class User extends Authenticatable implements JWTSubject, Auditable {

    use Notifiable,
        SoftDeletes,
        HasRoles,
        DataTable,
        \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'phone',
        'mobile',
        'password',
        'image',
        'first_name',
        'last_name',
        'gender',
        'postal_code',
        'fax_number',
        'birth_place',
        'birth_date',
        'address',
        'session_id',
        'is_confirm',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function transformAudit(array $data): array {
        if (Arr::has($data, 'new_values.role_id')) {
            $data['old_values']['role_name'] = Role::find($this->getOriginal('role_id'))->name;
            $data['new_values']['role_name'] = Role::find($this->getAttribute('role_id'))->name;
        }
        return $data;
    }

    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPassword($token));
    }

    public function Confirm() {
        return $this->hasOne(UserConfirm::class);
    }

    public function Transaction() {
        return $this->hasMany(Transaction::class);
    }

    public function getFullname() {
        $user = $this;
        $fullName = $user->first_name . " " . $user->last_name;
        if (strlen($fullName) > 1) {
            return $fullName;
        } else {
            return $user->username;
        }
        return null;
    }

    public function getRolesInfo() {
        $user = $this;
        $roles = $user->Roles()->get()->pluck("name")->toArray();
        return implode(",", $roles);
    }

    public function getImageProfile() {
        $user = $this;
        if (!is_null($user->image)) {
            return $user->image;
        } else {
            if ((int) $user->gender == 1) {
                return "assets/dist/img/male.png";
            } else {
                return "assets/dist/img/female.png";
            }
        }
        return "assets/dist/img/user.png";
    }

    public function selectData(){
        return [
            'users.username as user_username',
            'users.email as user_email',
            'users.phone as user_phone',
            'users.is_confirm as user_is_confirm',
            'users.id as key_id'
        ];
    }

    public function dataTableQuery(){
        $user = \Auth::user();
        return self::where($this->table.".id", "!=", $user->id);
    }

    public function grantAccess($route){
        $user = \Auth::user();
        if(!$user->can("view_".$route)){
            return "hidden";
        }
        return null;
    }

    
}
