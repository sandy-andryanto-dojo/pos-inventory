<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Dashboard extends Model{

    public static function getLineChart($type){
        $year = date("Y");
        $response = array();
        for($i = 1; $i <=12; $i++){
            $response[] = Transaction::where("is_purchased", 1)
                ->whereRaw("YEAR(invoice_date) = ".$year." AND MONTH(invoice_date) = ".$i)
                ->where("type", $type)
                ->sum("grandtotal");
        }
        return $response;
    }

    public static function getUserActivity(){
        $sql = "
            SELECT 
                users.id,
                COUNT(audits.user_id) as total
            FROM users
                INNER JOIN audits ON audits.user_id = users.id
                WHERE users.deleted_at IS NULL
            GROUP BY 
                users.id
        ";
        $str = trim(preg_replace('/\s+/', ' ', $sql));
        $data = DB::select($str);
        foreach($data as $row){
            $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            $username = \App\Helpers\CommonHelper::getFullNameUser($row->id);
            $response[] = array(
                "value"=> $row->total,
                "color"=> $color,
                "highlight"=>"#f56954",
                "label"=> $username
            );
        }
        return $response;
    }

    public static function getProductNowYear($type){
        $response = array();
        $date_start = date("Y-01-01");
        $date_end = date("Y-12-31");
        $sql = "
            SELECT 
                products.id,
                products.name,
                SUM(qty) as total_items,
                SUM(total) as total_cost
            FROM products
                INNER JOIN transactions_details ON transactions_details.product_id = products.id
                INNER JOIN transactions ON transactions.id = transactions_details.transaction_id
                WHERE transactions.deleted_at IS NULL 
                AND DATE(transactions.created_at) >= '".$date_start."' AND DATE(transactions.created_at) <= '".$date_end."' AND transactions.type = ".$type."
                GROUP BY products.id, products.name 
                ORDER BY products.id, products.name 
        ";
        $str = trim(preg_replace('/\s+/', ' ', $sql));
        $data = DB::select($str);
        foreach($data as $row){
            $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            $response[] = array(
                "value"=> $row->total_items,
                "color"=> $color,
                "highlight"=>"#f56954",
                "label"=> $row->name
            );
        }
        return $response;
    }

   
    
}
