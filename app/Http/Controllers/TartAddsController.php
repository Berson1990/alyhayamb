<?php

namespace App\Http\Controllers;

use App\Items;
use App\TartAdds;
use App\tart_adds;
use Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TartAddsController extends Controller
{
    public function __construct()
    {
        $this->items = new Items();
        $this->TartAdds = new TartAdds();

    }

    public function TartAddsIndex()
    {
        return view('tartads.tartads');
    }

    public function addTartAdds(Request $request)
    {
        $this->validate($request, [
            'add_namear' => 'required',
            'add_nameen' => 'required',
            'add_quantity' => 'required',
            'add_price' => 'required',
            'add_image' => 'required',
        ]);
//        return $request;

        $item = new TartAdds;
        $item->add_namear = $request->input('add_namear');
        $item->add_nameen = $request->input('add_nameen');
        $item->add_quantity = $request->input('add_quantity');
        $item->add_price = $request->input('add_price');
        $image = $request->input('add_image');
        $Id = time();
        $realbath = '/var/www/html/bakery/bBakery/public';
        $filename = $Id . '.' . 'jpg';
        $location = $realbath . '/tartImages/' . $filename;
        Image::make($image)->resize(500, 350)->save($location);
        $item->add_image = $filename;
        $item->save();

        return response()->json($item);
    }


    public function getTartAdds()
    {

        $output = TartAdds::All();
//        $items = [];
//        foreach ($output as $item){
//            if($lang=='ar'){
//                $item->add_namear= $item->add_namear;
////                $item->add_nameen= $item->add_nameen;
////                $item->messure_unit_ar= $item->messure_unit_ar;
//                array_push($items,$item);
//            }else if($lang=='en'){
//                $item->add_namear= $item->add_nameen;
//
//                array_push($items,$item);
//
//            }}
        return response()->json($output);

    }

    public function requestAddOnTart()
    {

    }

    public function UpdateTartAdds($id)
    {
        $input = Request()->all();
        if (!empty($input['add_image'])) {
            $image = $input['add_image'];
            $Id = time();
            $realbath = '/var/www/html/bakery/bBakery/public';
            $filename = $Id . '.' . 'jpg';
            $location = $realbath . '/tartImages/' . $filename;
            Image::make($image)->resize(500, 350)->save($location);
            $input['add_image'] = $filename;
            $this->TartAdds->find($id)->update($input);
        } else {
            $this->TartAdds->find($id)->update([
                "add_namear"=>$input['add_namear'],
                "add_nameen"=>$input['add_nameen'],
                "add_quantity"=>$input['add_quantity'],
                "add_price"=>$input['add_price']
            ]);

        }
    }

    public function DeleteTartAdds($id)
    {

         $this->TartAdds->where('adds_id', $id)->delete();
    }


}
