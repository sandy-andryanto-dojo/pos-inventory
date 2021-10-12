<?php

namespace App\Http\Controllers\Main\Product;

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageController extends MainController{

    public function __construct(){
        $this->layout = "main.product.image";
        $this->route = "product_images";
        $this->title = "Images";
        $this->subtitle = "product images";
        $this->model = new ProductImage;
        $this->dataTableModel = base64_encode(ProductImage::class);
    }

    public function create(){
       $this->data["products"] = Product::orderBy("name", "ASC")->get();
       return parent::create();
    }

    public function store(Request $request){
        $rules = $this->createValidation();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{
            $image = "assets/dist/img/no-image.png";
            if($request->file('image')){
                $file = $request->file('image');
                $imageName = md5(rand(0,1000)."".time()).'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads');
                $file->move($destinationPath, $imageName);
                $image = 'uploads/'.$imageName;
            }
            $model = ProductImage::create([
                "product_id" => $request->get("product_id"),
                "path" => $image,
                "is_primary" => $request->get("is_primary") ? 1 : 0,
            ]);
            if($request->get("is_primary")){
                ProductImage::where("id", "!=", $model->id)->update(["is_primary" => 0]);
            }
            return redirect()->route($this->route.".show", ["id"=>$model->id])->with('success', self::SUCCESS_MESSAGE_CREATED);
        }
    }

    public function update($id, Request $request){
        $rules = $this->updateValidation($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{

            $model = ProductImage::where("id", $id)->first();
            $image = isset($model->path) ? $model->path : "assets/dist/img/no-image.png";
            if($request->file('image')){
                if(isset($model->path)){
                    if(file_exists(public_path($model->path))){
                        unlink(public_path($model->path));
                    }
                }
                $file = $request->file('image');
                $imageName = md5(rand(0,1000)."".time()).'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads');
                $file->move($destinationPath, $imageName);
                $image = 'uploads/'.$imageName;
            }

            $model->product_id = $request->get("product_id");
            $model->path = $image;
            $model->is_primary =  $request->get("is_primary") ? 1 : 0;
            $model->save();

            if($request->get("is_primary")){
                ProductImage::where("id", "!=", $model->id)->update(["is_primary" => 0]);
            }

            return redirect()->route($this->route.".show", ["id"=>$model->id])->with('success', self::SUCCESS_MESSAGE_UPDATED);
            
        }
    }

    public function edit($id){
        $this->data["products"] = Product::orderBy("name", "ASC")->get();
        return parent::edit($id);
     }

    protected function createValidation(){
        return [
            'product_id' => 'required',
        ];
    }

    protected function updateValidation($id){
        return $this->createValidation();
    }

}