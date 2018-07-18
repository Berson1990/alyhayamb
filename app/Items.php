<?php

namespace App;

use App\ItemImages;
use App\categories;
use Illuminate\Database\Eloquent\Model;
use App\favorites;
use Illuminate\Support\Facades\App;


class Items extends Model
{

    //
    protected $table = 'items';
    protected $primaryKey = 'item_id';
    protected $fillable = ['item_name', 'item_nameen', 'itemdetails_ar', 'itemdetails_en', 'price', 'category_id', 'sub_category_id', 'quantity', 'messure_unit_ar', 'messure_unit_en', 'item_totalrate', 'item_ratedtimes', 'item_isfavorite'];

    public function getItemNameAttribute($value)
    {
        if (App::getLocale() == 'en')
            $value = $this->item_nameen;
        return $value;
    }
    public function Offer(){
        return $this->hasMany('App\Ads','item_id');
    }

    public function getItemdetailsArAttribute($value)
    {

        if (App::getLocale() == 'en')
            $value = $this->itemdetails_en;
        return $value;
    }

    public function getMessureUnitArAttribute($value)
    {

        if (App::getLocale() == 'en')
            $value = $this->messure_unit_en;
        return $value;
    }

    public function category()
    {
        return $this->belongsTo('App\categories', 'category_id');
    }

    public function favorites()
    {
        return $this->hasMany('App\favorites', 'item_id');
    }

    public function cart()
    {
        return $this->hasMany('App\Cart', 'item_id');
    }

    public function itemimages()
    {
        return $this->hasMany('App\ItemImages', 'item_id');
    }

    public function addItem($request)
    {


        $item = new Items;

        $item->item_name = $request->input('itemname_ar');
        $item->item_nameen = $request->input('itemname_en');
        $item->itemdetails_ar = $request->input('itemdetails_ar');
        $item->itemdetails_en = $request->input('itemdetails_en');
        $item->price = $request->input('price');
        $item->category_id = $request->input('category_id');
        $item->sub_category_id = $request->input('sub_category_id');
        $item->quantity = $request->input('quantity');
        $item->messure_unit_ar = $request->input('messure_unit_ar');
        $item->messure_unit_en = $request->input('messure_unit_en');

        $item->save();
        $itemId = $item->item_id;
        $noOfImages = count($request->item_image);

        ///////////
        ///////////
        for ($i = 0; $i < $noOfImages; $i++) {
//            return $request->input('item_image')[$i];
            (new ItemImages)->storeItemImage($itemId, $request->input('item_image')[$i]);
        }
        $categories = new categories();
        $itemModel = new Items();
        $item = $item->with('itemimages')
            ->leftJoin($categories->getTable(), $itemModel->getTable() . '.category_id', '=', $categories->getTable() . '.categories_id')
            ->where($itemModel->getTable() . '.item_id', '=', $itemId)
            ->get();

        return response()->json($item[0]);
    }

    public function getItems($request)
    {

    }

    public function tartColor()
    {
        return $this->hasMany('App\TartColor', 'color_id');
    }

    public function tartSize()
    {
        return $this->hasMany('App\Tart_Size', 'size_id');
    }
//    public function tartAdds()
//    {
//        return $this->hasMany('App\TartAdds','adds_id');
//    }

}
