<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ItemsController;
//echo 'test';
use App\Items;

class Filteration extends ItemsController
{
    public function popularetiFilterCategory( $category_id, $user_id)
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
            ->where('category_id', '=', $category_id)->where('category_id', '=', $category_id)
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

    public function priceFilterCategory($category_id, $user_id)
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
            ->where('category_id', '=', $category_id)
            ->orderBy('price', 'asc')
            ->get();
//        $items = [];
//
//
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

    public function priceFilter($user_id)
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
            ->orderBy('price', 'asc')
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

    public function newArravalFilter($user_id)
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
            ->latest()->limit(10)->get();
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

    public function newArravalFilterCategory($category_id, $user_id)
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
            ->latest()->limit(10)->get();
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

//        $items->each(function ($item, $key) {
//            //
//        });
        return Response()->json($output);
    }


    public function topRated($user_id)
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
        ])->orderBy('rate', 'desc')->get();
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
//                array_push($items, $item);
//            }
//        }
        return Response()->json($output);
    }

}