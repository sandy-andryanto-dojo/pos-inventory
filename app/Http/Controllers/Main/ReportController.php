<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends MainController{

    const REPORT_SALE = 1;
    const REPORT_PURCHASE = 2;
    const REPORT_FEE = 3;

    public function __construct(){
        $this->layout = "main.transaction.report";
        $this->route = "reports";
        $this->title = "Report";
        $this->subtitle = "report transaction";
        $this->model = new Report;
        $this->dataTableModel = base64_encode(Report::class);
    }

    public function show($id){
        $types = array(1, 2, 3);
        $this->data["title"] = $this->title;
        $this->data["subtitle"] = $this->subtitle;
        $this->data["route"] = $this->route;
        if(in_array($id, $types)){
            if($id == self::REPORT_SALE){
                return $this->__render__page($this->layout.".sale", $this->data);
            }
            if($id == self::REPORT_PURCHASE){
                return $this->__render__page($this->layout.".purchase", $this->data);    
            }
            if($id == self::REPORT_FEE){
                return $this->__render__page($this->layout.".fee", $this->data);
            }
        }else{
            return abort(404);  
        }
    }

    public function create(){
        return abort(404);  
    }

    public function store(Request $request){
        return abort(404);  
    }

    public function edit($id){
        return abort(404);  
    }

    public function update($id, Request $request){
        $types = array(1, 2, 3);
        if(in_array($id, $types)){
            $report_type = $request->get("report_type");
            $filter = $request->get("filter");
            $date_start = $request->get("date_start");
            $date_end = $request->get("date_end");
            $data = Report::getTransaction($report_type, $filter, $date_start, $date_end);
            if($id == self::REPORT_SALE){
                if((int) $filter == 1){
                    return view("main.report.sale.period", ["data"=> $data]);
                }
                if((int) $filter == 2){
                    return view("main.report.sale.product", ["data"=> $data]);
                }
                if((int) $filter == 3){
                    return view("main.report.sale.customer", ["data"=> $data]);
                }
            }
            if($id == self::REPORT_PURCHASE){
                if((int) $filter == 1){
                    return view("main.report.purchase.period", ["data"=> $data]);
                }
                if((int) $filter == 2){
                    return view("main.report.purchase.product", ["data"=> $data]);
                }
                if((int) $filter == 3){
                    return view("main.report.purchase.supplier", ["data"=> $data]);
                }
            }
            if($id == self::REPORT_FEE){
                if((int) $filter == 1){
                    return view("main.report.fee.period", ["data"=> $data]);
                }
                if((int) $filter == 2){
                    return view("main.report.fee.stakeholder", ["data"=> $data]);
                }
            }
        }else{
            return abort(404);  
        }
    }

    public function destroy($id){
        return abort(404);  
    }

}