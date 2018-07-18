<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\OrderDetails;
use App\Items;
use App\ItemImages;

class DelegateController extends Controller
{

    public function __construct()
    {

        $this->delegate = new User();
        $this->users = new User();
        $this->order = new Order();
        $this->order_details = new OrderDetails();
        $this->items = new Items();
        $this->items_images = new ItemImages();
    }

    public function GetAllOrders()
    {
        return $this->order->all();
    }

    public function DelegateIndex()
    {
        return view('delegate.delegate');
    }

    public function GetDelegate()
    {
        return $this->delegate->where('type', 2)->get();

    }

    public function GetOrderDelegate($id)
    {
        return $this->order
            ->leftjoin($this->users->getTable(), $this->order->getTable() . '.user_id', '=', $this->users->getTable() . '.user_id')
            ->where('delegate_id', $id)
            ->get();

    }

    public function CreateDelegate()
    {
        $input = Request()->all();
        $input['password'] = md5($input['password']);
        $input['type'] = 2;
        return $this->delegate->create($input);
    }

    public function UpdateDelegate($id)
    {
        $this->delegate->find($id)->update(Request()->all());
        return 'true';
    }

    public function AssginDelegateTOOrder($order_id, $deletage_id)
    {
        $this->order->where('order_id', $order_id)->update([
            'delegate_id' => $deletage_id,
            'order_state' => 2
        ]);
        return $this->order
            ->leftjoin($this->users->getTable(), $this->order->getTable() . '.user_id', '=', $this->users->getTable() . '.user_id')
            ->where('order_id', $order_id)->get();
    }

    public function DeleteDelegate($id)
    {
        $this->delegate->find($id)->delete();
        return 'true';

    }

    public function DeleteAssginOrder($id)
    {
        $this->order->where('order_id', $id)->update(['delegate_id' => '0']);
        return 'true';
    }

    public function GetDeletageOrdersAPI($id)
    {
        return $this->order
            ->withCount('OrderDeatails')
            ->with(['OrderDeatails' => function ($Query) {
                $Query
                    ->with(['Items' => function ($query) {
                        $query->with('itemimages');
                    }]);
            }, 'Users', 'Location'])
            ->where($this->order->getTable() . '.delegate_id', '=', $id)
            ->where($this->order->getTable() . '.order_state', '=', 2)
            ->get();

    }

    public function CloseOrderDilever($id)
    {

        $this->order->find($id)->update(['order_state' => 3]);
        return ['state' => '202'];
    }


}
