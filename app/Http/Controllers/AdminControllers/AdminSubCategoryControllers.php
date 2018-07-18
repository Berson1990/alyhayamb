<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\categories;
use App\SubCategory;
use Illuminate\Http\Request;

class AdminSubCategoryControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->category = new categories();
        $this->sub_category = new SubCategory();
    }

    public function indexPage()
    {
        return view('subcategory.subcategory');
        //
    }

    public function index()
    {
        //
        return $this->category
            ->join($this->sub_category->getTable(), $this->category->getTable() . '.categories_id', '=', $this->sub_category->getTable() . '.categories_id')
            ->get();
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
        $output = $this->sub_category->create($input);
        $ctegory_id = $output->sub_category_id;

        return $this->category
            ->join($this->sub_category->getTable(), $this->category->getTable() . '.categories_id', '=', $this->sub_category->getTable() . '.categories_id')
            ->where($this->sub_category->getTable() . '.sub_category_id', '=', $ctegory_id)
            ->get();
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
        $output = $this->sub_category->find($id)->update($input);
        return $this->category
            ->join($this->sub_category->getTable(), $this->category->getTable() . '.categories_id', '=', $this->sub_category->getTable() . '.categories_id')
            ->where($this->sub_category->getTable() . '.sub_category_id', '=', $id)
            ->get();

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
        return $this->sub_category->where('sub_category_id', $id)->delete();
    }

    public function GetSubCategory($id)
    {
        return $this->sub_category->where('categories_id', $id)->get();
    }
}
