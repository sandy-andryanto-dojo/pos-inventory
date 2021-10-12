<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Utils\CropImage;

class UploadController extends BaseController{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function userProfile(Request $request){

        $avatarSrc = isset($_POST['avatar_src']) ? $_POST['avatar_src'] : null;
        $avatarData = isset($_POST['avatar_data']) ? $_POST['avatar_data'] : null;
        $avatarFile = isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null;

        $crop = new CropImage($avatarSrc, $avatarData, $avatarFile);
        $result = str_replace(public_path(), NULL, $crop->getResult());
        $user = \Auth::user();
        $realPhoto = $result;

        $arr_photo = explode('/', $result);
        if (!is_dir(public_path() . "/uploads/users/")) {
            mkdir(public_path() . "/uploads/users/");
        }

        $photo = 'uploads/users/' . end($arr_photo);
        $copy = copy(public_path() . '/' . $result, public_path() . '/' . $photo);

        if ($copy) {
            if ($user->image) {
                if (file_exists($user->image)) {
                    unlink(public_path() . '/' . $user->image);
                }
            }
            $realPhoto = $photo;
            $user->image = $photo;
            $user->save();

            if ($crop->getOriginal()) {
                $original = str_replace(public_path(), NULL, $crop->getOriginal());
                if (file_exists(public_path() . '/' . $original)) {
                    unlink(public_path() . '/' . $original);
                }
            }
            unlink(public_path() . '/' . $result);
        }

        $response = array(
            'state' => 200,
            'message' => $crop->getMsg(),
            'result' => "/" . $realPhoto
        );

        return response()->json($response);

    }

}