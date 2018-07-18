<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\categories;

class AdminCategoryControllers extends Controller
{

    public function __construct()
    {
        $this->category = new categories();
        $this->baseurl = '';
        $this->realbath = '/var/www/html/bakery/bBakery/public';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexPage()
    {
        return view('category.category');

    }

    public function index()
    {
        //
        return $this->category->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = Request()->all();
        if (empty($input['category_image'])) {
            $output = $this->category->create($input);
        } else {

            $image = $input["category_image"];
            $jpg_name = time() . ".jpg";
            $path = $this->realbath . "/categoriesImages/" . $jpg_name;
            $input["category_image"] = $jpg_name;
            $img = substr($image, strpos($image, ",") + 1);//take string after ,
            $imgdata = base64_decode($img);
            $success = file_put_contents($path, $imgdata);
            $output = $this->category->create($input);
        }
        return $output;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = Request()->all();

        if (empty($input['category_image'])) {
            $this->category->find($id)->update([
                "categoryname_ar"=>$input["categoryname_ar"],
                "categoryname_en"=>$input["categoryname_en"],
                "category_activation"=>$input["category_activation"],
            ]);
        } else {
            $image = $input["category_image"];
            $jpg_name = time() . ".jpg";
            $path = $this->realbath . "/categoriesImages/" . $jpg_name;
            $input["category_image"] = $jpg_name;
            $img = substr($image, strpos($image, ",") + 1);//take string after ,
            $imgdata = base64_decode($img);
            $success = file_put_contents($path, $imgdata);
            $this->category->find($id)->update($input);
        }

        return $this->category->find($id)->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->category->where('categories_id', $id)->delete();
    }
}
