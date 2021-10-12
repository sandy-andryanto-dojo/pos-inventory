<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use App\Models\Transaction as TransactionModel;
use DB;

class Report extends TransactionModel{
    
    const REPORT_SALE = 1;
    const REPORT_PURCHASE = 2;
    const REPORT_FEE = 3;

    public static function getTransaction($report_type, $filter, $date_start, $date_end){
        $tr = new self;
        if((int) $report_type == self::REPORT_SALE){
            if((int) $filter == 1){
                return $tr->transactionByPeriode(self::REPORT_SALE, $date_start, $date_end);
            }
            if((int) $filter == 2){
                return $tr->productByPeriode(self::REPORT_SALE, $date_start, $date_end);
            }
            if((int) $filter == 3){
                return $tr->customerByPeriode(self::REPORT_SALE, $date_start, $date_end);
            }
        }
        if((int) $report_type == self::REPORT_PURCHASE){
            if((int) $filter == 1){
                return $tr->transactionByPeriode(self::REPORT_PURCHASE, $date_start, $date_end);
            }
            if((int) $filter == 2){
                return $tr->productByPeriode(self::REPORT_PURCHASE, $date_start, $date_end);
            }
            if((int) $filter == 3){
                return $tr->supplierByPeriode(self::REPORT_PURCHASE, $date_start, $date_end);
            }
        }
        if((int) $report_type == self::REPORT_FEE){
            if((int) $filter == 1){
                return $tr->transactionByPeriode(self::REPORT_FEE, $date_start, $date_end);
            }
            if((int) $filter == 2){
                return $tr->stakeholderByPeriode(self::REPORT_FEE, $date_start, $date_end);
            }
        }
    }

    private function transactionByPeriode($type, $date_start, $date_end){
        return self::where("type", $type)
            ->where("is_purchased", 1)
            ->whereDate("transactions.created_at", ">=", $date_start)
            ->whereDate("transactions.created_at", "<=", $date_end)
            ->orderBy("id", "DESC")
            ->get();
    }

    private function productByPeriode($type, $date_start, $date_end){
        $sql = "
            SELECT 
                brands.name as brand_name,
                categories.name as category_name,
                products.sku as product_sku,
                products.name as product_name,
                SUM(qty) as total_items,
                SUM(total) as total_cost
            FROM products
                INNER JOIN transactions_details ON transactions_details.product_id = products.id
                INNER JOIN transactions ON transactions.id = transactions_details.transaction_id
                INNER JOIN brands ON brands.id = products.brand_id
                INNER JOIN categories ON categories.id = products.category_id
                WHERE transactions.deleted_at IS NULL 
                AND DATE(transactions.created_at) >= '".$date_start."' AND DATE(transactions.created_at) <= '".$date_end."' AND transactions.type = ".$type."
                GROUP BY products.id, brands.name, categories.name, products.sku, products.name 
                ORDER BY brands.name, categories.name, products.sku, products.name 
        ";
        $str = trim(preg_replace('/\s+/', ' ', $sql));
        return DB::select($str);
    }

    private function customerByPeriode($type, $date_start, $date_end){
        $sql = "
            SELECT 
                customers.name as customer_name,
                SUM(qty) as total_items,
                SUM(total) as total_cost
            FROM products
                INNER JOIN transactions_details ON transactions_details.product_id = products.id
                INNER JOIN transactions ON transactions.id = transactions_details.transaction_id
                INNER JOIN customers ON customers.id = transactions.customer_id
                WHERE transactions.deleted_at IS NULL
                AND DATE(transactions.created_at) >= '".$date_start."' AND DATE(transactions.created_at) <= '".$date_end."' AND transactions.type = ".$type."
                GROUP BY customers.name 
                ORDER BY customers.name 
        ";
        $str = trim(preg_replace('/\s+/', ' ', $sql));
        return DB::select($str);
    }

    private function supplierByPeriode($type, $date_start, $date_end){
        $sql = "
            SELECT 
                suppliers.name as supplier_name,
                SUM(qty) as total_items,
                SUM(total) as total_cost
            FROM products
                INNER JOIN transactions_details ON transactions_details.product_id = products.id
                INNER JOIN transactions ON transactions.id = transactions_details.transaction_id
                INNER JOIN suppliers ON suppliers.id = transactions.supplier_id
                WHERE transactions.deleted_at IS NULL
                AND DATE(transactions.created_at) >= '".$date_start."' AND DATE(transactions.created_at) <= '".$date_end."' AND transactions.type = ".$type."
                GROUP BY suppliers.name 
                ORDER BY suppliers.name 
        ";
        $str = trim(preg_replace('/\s+/', ' ', $sql));
        return DB::select($str);
    }

    private function stakeholderByPeriode($type, $date_start, $date_end){
        $sql = "
            SELECT 
                stakeholders.name as stakeholder_name,
                SUM(transactions.grandtotal) as total_cost
            FROM transactions
                INNER JOIN stakeholders ON stakeholders.id = transactions.stakeholder_id
                WHERE transactions.deleted_at IS NULL
                AND DATE(transactions.created_at) >= '".$date_start."' AND DATE(transactions.created_at) <= '".$date_end."' AND transactions.type = ".$type."
                GROUP BY stakeholders.name 
                ORDER BY stakeholders.name 
        ";
        $str = trim(preg_replace('/\s+/', ' ', $sql));
        return DB::select($str);
    }

}