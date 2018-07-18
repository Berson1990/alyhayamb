<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::get('/test',
//    function (){
//        return 'hi';
//    });
Route::post('/editaccount/{lang}', 'UserController@editaccount');
Route::post('/signup/{lang}', 'UserController@signup');
Route::post('/login/{lang}', 'UserController@login');
Route::post('/forgetpass/{lang}', 'UserController@ForgetPassword');
//Route::post('loginapp/{lang}', 'UserController@login');
//    ->middleware('checkuser');
Route::post('/tweeterAuth', 'UserController@tweeterAuth');
Route::post('/facebookAuth', 'UserController@facebookAuth');

//////////////////tart//////////////////////////////////////////////////////////////////////
Route::post('/addTartAdds', 'TartAddsController@addTartAdds')->middleware('apilang');
Route::post('/requestAddOnTart', 'TartAddsController@requestAddOnTart');
Route::get('/getTartAdds', 'TartAddsController@getTartAdds')->middleware('apilang');
Route::post('/addTartColor', 'TartColorController@addTartColor');
Route::get('/getTartColor/', 'TartColorController@getTartColor');
Route::post('/addTartSize', 'TartSizeController@addTartSize');
Route::get('/getTartSize', 'TartSizeController@getTartSize');
////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/getAllCategories', 'CategoryController@getAllCatecories')->middleware('apilang');
Route::get('/getsubcategory/{id}', 'CategoryController@getSubCatecories')->middleware('apilang');
Route::get('/getActiveCategories', 'categoriesController@getActiveCatecories');
Route::post('/makeCategoryActiveDeactivate', 'categoriesController@makeCategoryActiveDeactivate');
Route::post('/categoryDelete', 'categoriesController@categoryDelete');
Route::post('/addCategory', 'categoriesController@addCategory')->middleware('apilang');
////////////////rate////////////////////////////////////////////////////////////////////////
Route::post('/addItemRate', 'RateItemController@addItemRate');
Route::get('/topRated/{user_id}', 'Filteration@topRated')->middleware('apilang');
///////////////////items controller/////////////////////////////////////////////////////////
Route::post('addItem', 'ItemsController@addItem')->middleware('apilang');
Route::get('/getItems/{user_id}', 'ItemsController@getProducts')->middleware('apilang');
Route::get('/popularetiFilter/{user_id}', 'ItemsController@popularetiFilter')->middleware('apilang');
Route::get('/popularetiFilter/{category_id}/{user_id}', 'Filteration@popularetiFilterCategory')->middleware('apilang');
Route::get('/priceFilterCategory/{category_id}/{user_id}', 'Filteration@priceFilterCategory')->middleware('apilang');
Route::get('/priceFilter/{user_id}', 'Filteration@priceFilter')->middleware('apilang');
Route::get('/newArravalFilter/{user_id}', 'Filteration@newArravalFilter')->middleware('apilang');
Route::get('/newArravalFilterCategory/{category_id}/{user_id}', 'Filteration@newArravalFilterCategory')->middleware('apilang');
//->middleware('apilang');
Route::get('/getCategoryItems/{user_id}/{category_id}/', 'ItemsController@getCategoryProducts')->middleware('apilang');
/////////////////////////////////////
Route::put('/addTofavourite', 'FavoritesController@addToFavorites');
Route::post('/getUserfavourite/', 'FavoritesController@getUserfavourite')->middleware('apilang');
Route::post('/deleteItemFromFavourites', 'FavoritesController@deleteFavorites');
/////////////////////cart///////////////////////////////////
Route::post('/addToCart', 'CartController@addToCart');
Route::post('/getMyCart', 'CartController@getMyCart')->middleware('apilang');
//Route::post('/deleteItemFromCart', 'CartController@deleteItemFromCart');
Route::post('/makeOrder', 'CartController@makeOrder');
Route::post('/getCustomerHistory', 'HistoryinfoController@getCustomerHistory')->middleware('apilang');
//Route::post('/getCustomerHistory','CartController@getCustomerHistory');
Route::post('/cancelOrder', 'CartController@cancelOrder');
Route::post('/completedOrder', 'CartController@completedOrder');
Route::post('/getItemFromCart', 'CartController@getItemFromCart');
////////////////////////////////////////////////////////
Route::put('/addOrderLocation', 'UserorderlocationsController@addOrderLocation');
Route::post('/getMyLocations', 'UserorderlocationsController@getMyLocations');
Route::post('/deleteLocation', 'UserorderlocationsController@deleteLocation');

Route::get('slideroffer', 'AdsController@Slider')->middleware('apilang');
Route::get('otheroffer', 'AdsController@Offer')->middleware('apilang');

Route::get('getallbranchesapi', 'BranchesController@GetAllBraches')->middleware('apilang');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('serchforitem', 'ItemsController@Search')->middleware('apilang');


Route::post('addtocart', 'CartController@AddtoCart');
Route::get('gettartoptions/{id}', 'CartController@GetTartOptions')->middleware('apilang');
Route::get('getusercart/{user_id}', 'CartController@getCart')->middleware('apilang');
Route::get('modifayqty/{cart_id}/{typeof}', 'CartController@IncreseQTY');
Route::delete('deleteItemFromCart/{cart_id}', 'CartController@DeleteFromCart');


Route::get('getitemswithsubcategory/{sub_category_id}', 'ItemsController@getItemSubCategory')->middleware('apilang');

Route::get('getaboutpolicy', 'AboutAndPolicyController@GetAboutPolicy')->middleware('apilang');

Route::get('getapicontacus', 'ContactUsController@get')->middleware('apilang');
Route::get('socialmedia', 'ContactUsController@GetSocialMedia');

Route::post('sendmessage', 'ContactUsController@SendMessage');
Route::post('insertorder', 'OrderController@StoreOrder')->middleware('apilang');
Route::get('orderhistory/{id}', 'OrderController@OrderHistory')->middleware('apilang');

Route::get('getdelegate/{id}','DelegateController@GetDeletageOrdersAPI');
Route::get('deliverorder/{id}','DelegateController@CloseOrderDilever');
