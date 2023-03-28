
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

/*Route::get('/', function () {
	
    return view('auth.login');
	
}); */

Auth::routes();
Route::get('/', 'HomeController@index');//'auth\LoginController@showLoginForm')->name('home');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/deluser/{q}', 'deluserController@index');
Route::get('/branddel/{q}', 'branddelController@index');
Route::get('/catgdel/{q}', 'catgdelController@index');
Route::get('/homeShow/{q}', 'HomeController@show');
Route::get('/shareShow/{q}', 'sellshareController@show');
Route::get('/stockdel/{q}', 'stockdelController@index');
Route::get('/expdel/{q}', 'expdelController@index');
Route::get('/lostdel/{q}', 'lostdelController@index');
Route::get('/closemonth/{q}', 'closemonthController@index');



Route::resource('/home', 'HomeController');
Route::resource('/changepassword', 'changepasswordController');
Route::resource('/changeemail', 'changeemailController');
Route::resource('/listdeluser', 'listdeluserController');
Route::resource('/expense', 'expenseController');
Route::resource('/deluserfinal', 'deluserfinalController');
Route::resource('/additem', 'additemController');
Route::resource('/brandnd', 'brandndController');
Route::resource('/brandnew', 'brandnewController');
Route::resource('/catgnd', 'catgndController');
Route::resource('/catgnew', 'catgnewController');
Route::resource('/savePrint', 'savePrintController');
Route::resource('/retbycust', 'retbycustController');
Route::resource('/rettowhole', 'rettowholeController');
Route::resource('/lost', 'lostController');
Route::resource('/sellshare', 'sellshareController');
Route::resource('/instock', 'instockController');
Route::resource('custfound', 'custfoundController');
Route::resource('wholefound', 'wholefoundController');
Route::resource('lostfound', 'lostfoundController');
Route::resource('profit', 'profitController');
Route::resource('profitfound', 'profitfoundController');
Route::resource('purchase', 'purchaseController');
Route::resource('purchasefound', 'purchasefoundController');
Route::resource('purchaseret', 'purchaseretController');
Route::resource('purchaseretfound', 'purchaseretfoundController');
Route::resource('/salesrep', 'salesrepController');
Route::resource('/salesrepfound', 'salesrepfoundController');
Route::resource('/salesretrep', 'salesretrepController');
Route::resource('/salesretrepfound', 'salesretrepfoundController');
Route::resource('/exp', 'expController');
Route::resource('/expfound', 'expfoundController');
Route::resource('/lostdam', 'lostdamController');
Route::resource('/lostdamfound', 'lostdamfoundController');
Route::resource('/closure', 'closureController');
Route::resource('/backup', 'backupController');


