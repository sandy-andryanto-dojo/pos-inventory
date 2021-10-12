<?php

namespace App\Http\Controllers\Main\Setting;

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserConfirm;
use App\Models\Role;

class UserController extends MainController{

    public function __construct(){
        $this->layout = "main.setting.user";
        $this->route = "users";
        $this->title = "User";
        $this->subtitle = "user management";
        $this->model = new User;
        $this->dataTableModel = base64_encode(User::class);
    }

    protected function __render__page($view, array $items){
        $items["roles"] = Role::all();
        return parent::__render__page($view,$items);
    }

    public function store(Request $request){
        $rules = $this->createValidation();

        if($request->get('phone')) $rules["phone"] = 'required|regex:/^[0-9]+$/|unique:users';

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{
            $token = base64_encode(strtolower($request->get("email").'.'.str_random(10)));
            $user = new User;
            $user->username = $request->get("username");
            $user->email = $request->get("email");
            $user->password = bcrypt($request->get('password'));
            $user->is_confirm = 1;
            $user->remember_token = $token;

            if($request->get("phone")){  $user->phone = $request->get("phone"); }

            $user->save();

            $this->syncPermissions($request, $user);
            $id = $user->id;
            return redirect()->route($this->route.".show", ["id"=>$id])->with('success', self::SUCCESS_MESSAGE_CREATED);

        }
    }

    public function update($id, Request $request){
        $rules = $this->updateValidation($id);

        if($request->get('phone')) $rules["phone"] = 'required|regex:/^[0-9]+$/|unique:users,phone,'.$id;
        if($request->get('password')) $rules["password"] = 'required|string|min:6|confirmed';

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{

            $user = User::findOrfail($id);
            $user->username = $request->get("username");
            $user->email = $request->get("email");
        
            if($request->get("password")) $user->password = bcrypt($request->get('password'));
            if($request->get("phone")) $user->phone = $request->get("phone");

            $user->save();
            $this->syncPermissions($request, $user);

            return redirect()->route($this->route.".show", ["id"=>$id])->with('success', self::SUCCESS_MESSAGE_UPDATED);
        }
    }

    protected function createValidation(){
        return [
            'username' => 'required|alpha_dash|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'required|min:1',
        ];
    }

    protected function updateValidation($id){
        return [
            'username' => 'required|alpha_dash|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|min:1',
        ];
    }

    private function syncPermissions(Request $request, $user){
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if(!$user->hasAllRoles($roles) ) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);

        $confirm = UserConfirm::where("user_id", $user->id)->first();
        if(is_null($confirm)){
            $token = base64_encode(strtolower($user->email.'.'.str_random(10)));
            UserConfirm::Create([
                'user_id'=>$user->id,
                'token'=>$token
            ]);
        }

        return $user;
    }

}