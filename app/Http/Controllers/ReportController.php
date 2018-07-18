<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetails;
use App\Cart;
use App\categories;
use App\SubCategory;
use App\Items;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->order = new Order();
        $this->order_details = new OrderDetails();
        $this->cart = new Cart();
        $this->categoris = new categories();
        $this->sub_category = new SubCategory();
        $this->items = new Items();
    }

    public function SalesReportIndex()
    {
        return view('salesreport.salesreport');
    }

    public function getRepotyDefault()
    {

        $input = Request()->all();
        $item_id = $input['item_id'];
        $categories_id = $input['categories_id'];
        $report = $this->order
            ->leftjoin($this->order_details->getTable(), $this->order->getTable() . '.order_id', '=', $this->order_details->getTable() . '.order_id')
            ->leftjoin($this->items->getTable(), $this->order_details->getTable() . '.item_id', '=', $this->items->getTable() . '.item_id')
            ->leftjoin($this->categoris->getTable(), $this->items->getTable() . '.category_id', $this->categoris->getTable() . '.categories_id')
            ->leftjoin($this->sub_category->getTable(), $this->categoris->getTable() . '.categories_id', $this->sub_category->getTable() . '.categories_id')
            ->where($this->order->getTable() . '.created_at', '>=', $input['fromDate'])
            ->where($this->order->getTable() . '.created_at', '<=', $input['toDate']);
        if ($item_id > 0) {
            $report->where($this->items->getTable() . '.item_id', $item_id);

        }
        if ($categories_id > 0) {
            $report->where($this->items->getTable() . '.category_id', $categories_id);
        }
        $report->groupby($this->order->getTable() . '.order_id');
        $data = $report->get();
        return $data;
    }
}
