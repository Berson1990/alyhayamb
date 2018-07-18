<?php

namespace App\Http\Controllers;

use App\Items;
use App\TartAdds;
use Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\TartColor;


class TartColorController extends Controller
{

    public function __construct()
    {
        $this->items = new Items();
        $this->TartColor = new TartColor();

    }

    public function TartColorIndex()
    {
        return view('tartcolor.tartcolor');
    }

    public function addTartColor(Request $request)
    {
        $this->validate($request, [
            'tart_colorImage' => 'required',
            'color_name' => 'required',
            'color_discribtion' => 'required',
        ]);
//        return $request;
        $item = new TartColor;
//        $item->tart_colorImage= $request->input('tart_colorImage');
        $item->color_name = $request->input('color_name');
        $item->color_discribtion = $request->input('color_discribtion');
        $image = $request->input('tart_colorImage');
        $Id = time();
        $realbath = '/var/www/html/bakery/bBakery/public';
        $filename = $Id . '.' . 'jpg';
        $location = $realbath . '/tartColors/' . $filename;
        Image::make($image)->resize(500, 350)->save($location);
        $item->tart_colorImage = $filename;
//        return $item;

        $item->save();

        return response()->json($item);
    }


    public function getTartColor()
    {

        $output = TartColor::All();
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

    public function UpdateTartColor($id)
    {
        $input = Request()->all();
        if (!empty($input['tart_colorImage'])) {

            $image = $input['tart_colorImage'];
            $Id = time();
            $realbath = '/var/www/html/bakery/bBakery/public';
            $filename = $Id . '.' . 'jpg';
            $location = $realbath . '/tartColors/' . $filename;
            Image::make($image)->resize(500, 350)->save($location);
            $input['color_name'] = $filename;
            $this->TartColor->find($id)->update($input);

        } else {
            $this->TartColor->find($id)->update([
                "color_name" => $input["color_name"],
                "color_discribtion" => $input["color_discribtion"]
            ]);
        }
        return 'true';
    }

    public function DeleteTartColor($id)
    {

        $output = $this->TartColor->find($id)->delete();
        if ($output) {
            return 'true';
        } else {
            return 'false';
        }
    }


}
