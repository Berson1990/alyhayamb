<?php
namespace App\Http\Controllers;

use App\Http\Controllers\ItemsController;
//use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Items;
//use App\Http\Controllers\ItemsController;
 class RateItemController extends ItemsController{
     public function addItemRate(Request $request){
         $this->validate($request,[
             'item_rate_no'=>'required',
             'item_id'=>'required',
         ]);

         $Item=Items::where('item_id',$request->item_id)->get();
         $ItemRated=Items::where('item_id',$request->item_id)
             ->update([
                 'item_ratedtimes'=>($Item[0]->item_ratedtimes+1)
                 ,'item_totalrate'=>($Item[0]->item_totalrate+$request->item_rate_no)
                 ,'rate'=>($Item[0]->item_totalrate + $request->item_rate_no)/($Item[0]->item_ratedtimes + 1)
             ]);

        return (($Item[0]->item_totalrate + $request->item_rate_no)/($Item[0]->item_ratedtimes + 1));
     }


}