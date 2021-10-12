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
// Load Model
use App\Models\Product;
use App\Models\Brand;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Dashboard;

class DashboardController extends BaseController{

    public function summary(Request $request){
        $today = date("Y-m-d");
        $response = array();
        $response["count_purchase"] = Transaction::where("is_purchased", 1)->whereDate("created_at", "=", $today)->where("type", 2)->sum("grandtotal");
        $response["count_sale"] =  Transaction::where("is_purchased", 1)->whereDate("created_at", "=", $today)->where("type", 1)->sum("grandtotal");
        $response["count_product"] = Product::count();
        $response["count_customer"] = Customer::count();
        $response["count_supplier"] = Supplier::count();
        $response["count_brand"] = Brand::count();
        $response["piechart"] = array(
            "purchase_product"=> Dashboard::getProductNowYear(2),
            "sale_product"=> Dashboard::getProductNowYear(1),
            "user_activity"=> Dashboard::getUserActivity(),
        );
        $response["linechart"] = array(
            "purchase"=> Dashboard::getLineChart(2),
            "sale"=> Dashboard::getLineChart(1),
        );
        return response()->json($response);
    }

}