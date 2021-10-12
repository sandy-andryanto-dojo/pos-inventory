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
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends BaseController{

    public function getProduct(Request $request){
        $data = array();
        $products = Product::where("products.id", "<>", 0);
       

        if($request->get("category_id")){
            $products->where("category_id", $request->get("category_id"));
        }

        if($request->get("brand_id")){
            $products->where("brand_id", $request->get("brand_id"));
        }

        if($request->get("group_id")){
            $products->where("group_id", $request->get("group_id"));
        }

        if($request->get("keyword")){
            $word = $request->get("keyword");
            if(strlen($word) > 0){
                $products->where(function($q) use ($word) {
                    $q->Where("sku", 'like', '%' . $word . '%');
                    $q->orWhere("name", 'like', '%' . $word . '%');
                });
            }
        }

        $response = $products->get();

        $index = 4; // col-md-3 => 12 : 3 
        $max = count($response) > $index ? round(count($response) / $index) : count($response);

        $start = 0;
        $end = $index;

        for($i = 0; $i < $max; $i++){
            $html = '<div class="row">';

            for($j = $start; $j < $end; $j++){
                $row = $response;
                if(isset($row[$j]->id)){

                    $image = url("assets/dist/img/no-image.png");
                    $imagePrimary = ProductImage::where("product_id", $row[$j]->id)->where("is_primary", 1)->first();
                    $imageOrder = ProductImage::where("product_id", $row[$j]->id)->inRandomOrder()->first();

                    if(!is_null($imagePrimary)){
                        $image = url($imagePrimary->path);
                    }

                    if(is_null($imagePrimary) && !is_null($imageOrder)){
                        $image = url($imageOrder->path);
                    }

                    $icon = "<i class='fa fa-shopping-cart'></i>";
                    $price = (int) $request->get("type") == 1 ? "price_sale" : "price_purchase";
                    $html .= '
                        <a href="javascript:void(0);" class="product-item" data-product="'.base64_encode(json_encode($row[$j])).'">
                            <div class="col-md-3">
                                <div class="product-bond" data-toggle="tooltip" data-placement="bottom" data-html="true"  data-original-title="'.$icon.'&nbsp;Add to cart">
                                    <div class="text-center">
                                        <img src="'.$image.'" class="img-responsive img-thumbnail">
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <p></p>
                                        <div class="col-md-12 text-center">
                                            <p class="product-name">'.$row[$j]->sku.'</p>
                                            <p class="product-name">'.$row[$j]->name.'</p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 text-center">
                                            <span>Price</span>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <span>'.$row[$j]->$price.'</span>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 text-center">
                                            <span>Stock</span>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <span>'.$row[$j]->stock.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    ';
    
                }
            }

            $html .= '</div>';
            $html .= '<p></p>';
            $data[] = $html;

            $start += $index;
            $end += $index;
           
        }
        return response()->json($data);
    }

}