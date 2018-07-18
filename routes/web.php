<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test',
    function () {
        return 'hi';
    }
);
Route::get('/', function () {
   return view('welcome');
});

Route::get('test-mic' ,function (){
    return view('test');

});
//Route::group(['middleware'=>'web'],function (){
Route::post('/signup', 'UserController@signup');

//});
Route::post('loginapp/{lang}', 'UserController@login');

Route::post('adminapplogin','UserController@AdminLogin');
Route::get('item', 'ItemsController@getItemPage');
Route::get('getallitem', 'ItemsController@getAllITems')->middleware('apilang');
Route::get('deleteItem/{id}', 'ItemsController@DeleteItem');
Route::get('deletiamge/{id}', 'ItemsController@DeleteIamge');
Route::put('update/{id}', 'ItemsController@UpdateItem');

/* route catgeory */
Route::get('category', 'AdminControllers\AdminCategoryControllers@indexPage');
Route::get('gatcategory', 'AdminControllers\AdminCategoryControllers@index')->middleware('apilang');
Route::post('postcategory', 'AdminControllers\AdminCategoryControllers@store')->middleware('apilang');
Route::put('updatecategory/{id}', 'AdminControllers\AdminCategoryControllers@update')->middleware('apilang');
Route::get('deletecategory/{id}', 'AdminControllers\AdminCategoryControllers@destroy');
/* route catgeory end*/

/* sub category*/
Route::get('subcategory', 'AdminControllers\AdminSubCategoryControllers@indexPage');
Route::get('gatsubcategory', 'AdminControllers\AdminSubCategoryControllers@index')->middleware('apilang');
Route::post('postsubcategory', 'AdminControllers\AdminSubCategoryControllers@store')->middleware('apilang');
Route::put('updatesubcategory/{id}', 'AdminControllers\AdminSubCategoryControllers@update')->middleware('apilang');
Route::get('deletesubcategory/{id}', 'AdminControllers\AdminSubCategoryControllers@destroy');
Route::get('getsubcategory/{id}', 'AdminControllers\AdminSubCategoryControllers@GetSubCategory')->middleware('apilang');
/* sub category end*/

/* ads start*/
Route::get('ads', 'AdminControllers\AdminadsController@indexpage');
Route::get('getafs', 'AdminControllers\AdminadsController@getadds')->middleware('apilang');
Route::get('getItems', 'AdminControllers\AdminadsController@getItemforLockups');
Route::post('postads', 'AdminControllers\AdminadsController@store')->middleware('apilang');
Route::put('updateads/{id}', 'AdminControllers\AdminadsController@update');
Route::get('deleteads/{id}', 'AdminControllers\AdminadsController@destroy');
/*ads end*/

/**/
Route::get('tartadds', 'TartAddsController@TartAddsIndex');
Route::put('updatetartadds/{id}', 'TartAddsController@UpdateTartAdds');
Route::get('deletetartadds/{id}', 'TartAddsController@DeleteTartAdds');
/**/

Route::get('tcolor', 'TartColorController@TartColorIndex');
Route::put('updatetartcolor/{id}', 'TartColorController@UpdateTartColor');
Route::delete('deletetartcolor/{id}', 'TartColorController@DeleteTartColor');

Route::get('tartsizepage', 'TartSizeController@TartSizeIndex');
Route::put('updatetartsize/{id}', 'TartSizeController@updateTartSize');
Route::delete('deletetartsize/{id}', 'TartSizeController@DeleteTartSize');

/*tart floor*/
Route::get('tfloor', 'TartFloorController@TartFloorIndex');
Route::get('getallfloor', 'TartFloorController@GetAllTartFloor')->middleware('apilang');
Route::post('createfloor', 'TartFloorController@CreateNewTartFloor')->middleware('apilang');
Route::put('updatefloor/{id}', 'TartFloorController@updateTartFloor');
Route::delete('deletefloor/{id}', 'TartFloorController@DeleteTurtFloor');
/*tart floor*/

/* Sales report*/
Route::get('salesreport', 'ReportController@SalesReportIndex');
Route::post('report', 'ReportController@getRepotyDefault');
/* Sales report end*/


/*bracnces start*/
Route::get('branches', 'BranchesController@BranchesIndex');
Route::get('getallbranches', 'BranchesController@GetAllBraches')->middleware('apilang');
Route::post('createnewbranche', 'BranchesController@StoreBranches')->middleware('apilang');
Route::put('pudatebranche/{id}', 'BranchesController@UpdateBranches');
Route::get('deletebranche/{id}', 'BranchesController@DeleteBranches');
Route::get('deletebranchephone/{id}', 'BranchesController@DeleteBranchPhone');
/*bracnces end*/

/* tart options start*/
Route::get('tartoption', 'TartOptionController@TartOptions');
Route::get('gettartoptions', 'TartOptionController@GetTartOptions');
Route::post('postnewtartoptions', 'TartOptionController@CreateNewTartOptions');
Route::put('updatenewtartoptions/{id}', 'TartOptionController@UpdateTartOptions');
Route::get('deletetartoptions/{id}', 'TartOptionController@deletetartOptions');

/* tart options end*/


Route::get('getaboutpolicy', 'AboutAndPolicyController@GetAboutPolicy')->middleware('apilang');
Route::put('updateaboutpolicy/{id}', 'AboutAndPolicyController@UpdateAnoutPolicy');
Route::get('about_policy', 'AboutAndPolicyController@index');


// contact us

Route::get('contacus', 'ContactUsController@index');
Route::get('getcontacus', 'ContactUsController@get')->middleware('apilang');
Route::post('postcontacus', 'ContactUsController@create')->middleware('apilang');
Route::put('updatecontacus/{id}', 'ContactUsController@update');
Route::delete('deletecontacus/{id}', 'ContactUsController@delete');
Route::get('socialmedia', 'ContactUsController@SocialMeidaIndex');
Route::get('socialmediadata', 'ContactUsController@GetSocialMedia');
Route::put('updatesocialmedia/{id}', 'ContactUsController@updateSoical');

//deletage
Route::get('deletage', 'DelegateController@DelegateIndex');
Route::get('getdeletage', 'DelegateController@GetDelegate');
Route::get('allorder', 'DelegateController@GetAllOrders')->middleware('apilang');
Route::get('getdeletageorders/{id}', 'DelegateController@GetOrderDelegate');
Route::post('createdeletage', 'DelegateController@CreateDelegate');
Route::put('updatedeletage/{id}', 'DelegateController@UpdateDelegate');
Route::put('assgindeletagetoorder/{order_id}/{deletage_id}', 'DelegateController@AssginDelegateTOOrder');
Route::delete('deletedeletage/{id}', 'DelegateController@DeleteDelegate');
Route::put('deleteassgindeletage/{id}', 'DelegateController@DeleteAssginOrder');




Route::get('getaboutpolicy', 'AboutAndPolicyController@GetAboutPolicy')->middleware('apilang');




