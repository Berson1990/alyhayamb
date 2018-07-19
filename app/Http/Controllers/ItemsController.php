<?php

namespace App\Http\Controllers;

use App\Items;
use Illuminate\Http\Request;
use App\User;
use App\favorites;
use App\Cart;
use App\ItemImages;
use App\categories;
use App\SubCategory;
use App\Ads;

//require_once __DIR__ . '/vendor/autoload.php';
//
//use Rx\Observable;
//use React\EventLoop\Factory;
//use Rx\Scheduler;
class ItemsController extends Controller
{
    public function __construct()
    {
        $this->items = new Items();
        $this->favorites = new favorites();
        $this->cart = new Cart();
        $this->itemimages = new itemimages();
        $this->categories = new  categories();
        $this->sub_category = new SubCategory();
        $this->ads = new Ads();
    }

    public function addItem(Request $request)
    {


        return (new Items)->addItem($request);
    }

    public function getProducts($user_id)
    {
//        $item=(new Items())->item_id;
        $output = Items::with(['favorites' => function ($query) use ($user_id) {

            if (is_numeric($user_id)) {
                $query->where($this->favorites->getTable() . '.user_id', '=', $user_id);

            } else {
                $query->where($this->favorites->getTable() . '.token', '=', $user_id);
            }
        }
            , 'Cart' => function ($query) use ($user_id) {

                if (is_numeric($user_id)) {
                    $query->where($this->cart->getTable() . '.user_id', '=', $user_id)
                        ->where($this->cart->getTable() . '.state', '=', 'current');
                } else {
                    $query->where($this->cart->getTable() . '.token', '=', $user_id)
                        ->where($this->cart->getTable() . '.state', '=', 'current');
                }
            }, 'itemimages'])->get();
//        $items = [];
//        foreach ($output as $item) {
//
//            if ($lang == 'ar') {
//                $item->item_name = $item->item_name;
//                $item->itemdetails_ar = $item->itemdetails_ar;
//                $item->messure_unit_ar = $item->messure_unit_ar;
//                array_push($items, $item);
//            } else {
//                $item->item_name = $item->item_nameen;
//                $item->itemdetails_ar = $item->itemdetails_en;
//                $item->messure_unit_ar = $item->messure_unit_en;
//
//                array_push($items, $item);
//
//            }


//        }
        return Response()->json($output);
    }


    public function getCategoryProducts($user_id, $category_id)
    {
        $output = Items::with(['favorites' => function ($query) use ($user_id) {

            if (is_numeric($user_id)) {
                $query->where($this->favorites->getTable() . '.user_id', '=', $user_id);

            } else {
                $query->where($this->favorites->getTable() . '.token', '=', $user_id);
            }
        }
            , 'Cart' => function ($query) use ($user_id) {

                if (is_numeric($user_id)) {
                    $query->where($this->cart->getTable() . '.user_id', '=', $user_id);
                } else {
                    $query->where($this->cart->getTable() . '.token', '=', $user_id);
                }
            }, 'itemimages'
        ])->where('category_id', $category_id)->get();

//        $items = [];


//        foreach ($output as $item) {
//            if ($lang == 'ar') {
////                $item->item_name= $item->item_name;
////                $item->itemdetails_ar= $item->itemdetails_ar;
////                $item->messure_unit_ar= $item->messure_unit_ar;
//                array_push($items, $item);
//            } else {
//                $item->item_name = $item->item_nameen;
//                $item->itemdetails_ar = $item->itemdetails_en;
//                $item->messure_unit_ar = $item->messure_unit_en;
//
//                array_push($items, $item);
//
//            }
//        }


        return Response()->json($output);
    }

    public function popularetiFilter($user_id)
    {
        $output = Items::with(['favorites' => function ($query) use ($user_id) {

            if (is_numeric($user_id)) {
                $query->where($this->favorites->getTable() . '.user_id', '=', $user_id);

            } else {
                $query->where($this->favorites->getTable() . '.token', '=', $user_id);
            }
        }
            , 'Cart' => function ($query) use ($user_id) {

                if (is_numeric($user_id)) {
                    $query->where($this->cart->getTable() . '.user_id', '=', $user_id);
                } else {
                    $query->where($this->cart->getTable() . '.token', '=', $user_id);
                }
            }, 'itemimages'
        ])
            ->orderBy('popularety', 'desc')
            ->get();
//        $items = [];


//        foreach ($output as $item) {
//            if ($lang == 'ar') {
//                $item->item_name = $item->item_name;
//                $item->itemdetails_ar = $item->itemdetails_ar;
//                $item->messure_unit_ar = $item->messure_unit_ar;
//                array_push($items, $item);
//            } else {
//                $item->item_name = $item->item_nameen;
//                $item->itemdetails_ar = $item->itemdetails_en;
//                $item->messure_unit_ar = $item->messure_unit_en;
//
//                array_push($items, $item);
//
//            }
//        }
        return Response()->json($output);
    }

//    public function addItemRate(Request $request)
//    {
//        $this->validate($request, [
//            'item_rate_no' => 'required',
//            'item_id' => 'required',
//        ]);
//
//        $Item = Items::where('item_id', $request->item_id)->get();
//        $ItemRated = Items::where('item_id', $request->item_id)
//            ->update(['item_ratedtimes' => ($Item[0]->item_ratedtimes + 1),
//                'item_totalrate' => ($Item[0]->item_totalrate + $request->item_rate_no)]);
//        return ($Item[0]->item_ratedtimes + 1)/($Item[0]->item_totalrate + $request->item_rate_no);
//    }

//    this for admin panel
    public function getItemPage()
    {
        return view('item.item');
    }

    public function getAllITems()
    {
        $output = $this->items->with('itemimages')
            ->leftJoin($this->categories->getTable(), $this->items->getTable() . '.category_id', '=', $this->categories->getTable() . '.categories_id')
            ->leftJoin($this->sub_category->getTable(), $this->items->getTable() . '.sub_category_id', '=', $this->sub_category->getTable() . '.sub_category_id')
            ->groupBy($this->items->getTable() . '.item_id')
            ->get();

        return $output;
    }

    public function DeleteItem($id)
    {
        $this->items->where('item_id', '=', $id)->delete();
        $this->itemimages->where('item_id', '=', $id)->delete();
        $this->ads->where('item_id', $id)->delete();
        return ['state' => 202];
    }

    public function DeleteIamge($id)
    {
        $this->itemimages->where('itemimages_id', '=', $id)->delete();
        return ['state' => 202];
    }

    public function UpdateItem($id)
    {
        $request = Request()->all();
        if (empty($request['img'])) {


            $item = new Items;
//            $item->item_name = $request->input('itemname_ar');
//            $item->item_nameen = $request->input('itemname_en');
//            $item->itemdetails_ar = $request->input('itemdetails_ar');
//            $item->itemdetails_en = $request->input('itemdetails_en');
//            $item->price = $request->input('price');
//            $item->category_id = $request->input('category_id');
//            $item->quantity = $request->input('quantity');
//            $item->messure_unit_ar = $request->input('messure_unit_ar');
//            $item->messure_unit_en = $request->input('messure_unit_en');


            $item->where('item_id', $id)->update([
                'item_name' => $request['itemname_ar'],
                'item_nameen' => $request['itemname_en'],
                'itemdetails_ar' => $request['itemdetails_ar'],
                'itemdetails_en' => $request['itemdetails_en'],
                'price' => $request['price'],
                'category_id' => $request['categories_id'],
                'sub_category_id' => $request['sub_category_id'],
                'quantity' => $request['quantity'],
                'messure_unit_ar' => $request['messure_unit_ar'],
                'messure_unit_en' => $request['messure_unit_en']
            ]);

        } else {


            $item = new Items;
//            $item->item_name = $request->input('itemname_ar');
//            $item->item_nameen = $request->input('itemname_en');
//            $item->itemdetails_ar = $request->input('itemdetails_ar');
//            $item->itemdetails_en = $request->input('itemdetails_en');
//            $item->price = $request->input('price');
//            $item->category_id = $request->input('category_id');
//            $item->quantity = $request->input('quantity');
//            $item->messure_unit_ar = $request->input('messure_unit_ar');
//            $item->messure_unit_en = $request->input('messure_unit_en');

            $item->where('item_id', $id)->update([
                'item_name' => $request['itemname_ar'],
                'item_nameen' => $request['itemname_en'],
                'itemdetails_ar' => $request['itemdetails_ar'],
                'itemdetails_en' => $request['itemdetails_en'],
                'price' => $request['price'],
                'category_id' => $request['categories_id'],
                'sub_category_id' => $request['sub_category_id'],
                'quantity' => $request['quantity'],
                'messure_unit_ar' => $request['messure_unit_ar'],
                'messure_unit_en' => $request['messure_unit_en']
            ]);
            $noOfImages = count($request['img']);

            for ($i = 0; $i < $noOfImages; $i++) {
                (new ItemImages)->storeItemImage($id, $request['img'][$i]);
            }
        }


//        $item = $item->with('itemimages')
//            ->leftJoin(categories::getTable(), Items::getTable() . '.category_id', '=', categories::getTable() . '.categories_id')
//            ->where(Items::getTable() . '.item_id', '=', $id)
//            ->get();
//
//        return response()->json($item[0]);
    }

    public function getItemSubCategory($sub_category_id)
    {
        return $this->items->with('itemimages', 'favorites', 'cart', 'Offer')->where('sub_category_id', $sub_category_id)->get();

    }

    public function Search()
    {

        $input = Request()->all();

        return $this->items->with(['category' => function ($query) {
            $query->with('SubCtegroy');
        }, 'itemimages', 'favorites', 'cart', 'Offer'])
            ->where($this->items->getTable() . '.item_name', 'Like', '%' . $input['KeyWord'] . '%')
            ->Orwhere($this->items->getTable() . '.item_nameen', 'Like', '%' . $input['KeyWord'] . '%')
            ->get();

    }


}
