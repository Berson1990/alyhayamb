<?php

namespace App\Http\Controllers;

use App\Items;
use App\TartSize;
use App\TartAdds;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TartSizeController extends Controller
{

    public function __construct()
    {
        $this->items = new Items();
        $this->TartSize = new TartSize();

    }

    public function addTartSize(Request $request)
    {
        $this->validate($request, [
            'size_name' => 'required',
            'size_no' => 'required',
        ]);
        $item = new TartSize;
        $item->size_name = $request->input('size_name');
        $item->size_no = $request->input('size_no');
        $item->size_price = $request->input('size_price');
        $item->save();
        return response()->json($item);
    }


    public function getTartSize()
    {

        $output = TartSize::All();
        $items = [];
        foreach ($output as $item) {
//            if($lang=='ar'){
//                $item->add_namear= $item->add_namear;
//                $item->add_nameen= $item->add_nameen;
//                $item->messure_unit_ar= $item->messure_unit_ar;
            array_push($items, $item);
//            }else if($lang=='en'){
//                $item->add_namear= $item->add_nameen;

//                array_push($items,$item);

//            }
        }
        return response()->json($items);

    }

    public function TartSizeIndex()
    {
        return view('tartszie.tartszie');
    }

    public function updateTartSize($id, Request $request)
    {
        $input = Request()->all();

        $this->TartSize->find($id)->update($input);
        return 'true';
    }

    public function DeleteTartSize($id)
    {
        $this->TartSize->find($id)->delete();
    }


}
