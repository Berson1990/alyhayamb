<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Ads;
use App\Items;
use Illuminate\Http\Request;

class AdminadsController extends Controller
{
    //
    public function __construct()
    {
        $this->ads = new Ads();
        $this->item = new Items();
    }

    public function getItemforLockups()
    {
        return $this->item->all();
    }

    public function indexpage()
    {
        return view('ads.ads');
    }

    public function getadds()
    {
        return $this->ads
            ->join($this->item->getTable(), $this->ads->getTable() . '.item_id', '=', $this->item->getTable(). '.item_id')
            ->get();
    }

    public function store()
    {
        $input = Request()->all();
        $output = $this->ads->create($input);
        $ads_id = $output->ads_id;
        return $this->ads
            ->join($this->item->getTable(), $this->ads->getTable() . '.item_id', '=', $this->item->getTable(). '.item_id')
            ->where('ads_id', $ads_id)
            ->get();
    }

    public function update($id)
    {
        $input = Request()->all();
        $output = $this->ads->find($id)->update($input);

    }

    public function destroy($id)
    {
        $this->ads->where('ads_id', $id)->delete();
    }
}
