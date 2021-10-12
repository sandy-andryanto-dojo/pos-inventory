<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission {

    public static function defaultPermissions() {
        $result = array();
        $modules = [
           // Dashboard
           "dashboards",
           // References
           "banks",
           "customers",
           "stakeholders",
           "suppliers",
           // Products
           "brands",
           "groups",
           "categories",
           "items",
           "product_images",
           // Transactions
           "transaction_sales",
           "transaction_purchases",
           "transaction_fees",
           // Reports
           "reports",
           // Settings
           "roles",
           "settings",
           "users",
           "audits",
        ];
        asort($modules);
        $actions = ["view", "add", "edit", "delete"];
        foreach ($modules as $m) {
            foreach ($actions as $a) {
                $result[] = $a . "_" . $m;
            }
        }
        return $result;
    }

}
