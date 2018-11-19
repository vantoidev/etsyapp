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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin'], function() {
	Route::get('/', [
		'as'   => 'getDashboard',
		'uses' => 'Controller@getDashboard'
		//return view('admin.index');
	]);
	Route::group(['prefix'=>'cate'], function() {
		Route::get('get-top', [
			'as'   => 'getCateTop',
			'uses' => 'CateController@getTop'
		]);
		Route::post('post-top', [
			'as'   => 'postCateTop',
			'uses' => 'CateController@postTop'
		]);
		Route::get('get-sub/{id}', [
			'as'   => 'getCateSub',
			'uses' => 'CateController@getSub'
		]);
		Route::get('list', [
			'as'   => 'getCateList',
			'uses' => 'CateController@getList'
		]);
		Route::get('delete/{id}', [
			'as'   => 'getCateDelete',
			'uses' => 'CateController@getDelete'
		]);
		Route::get('update/{id}', [
			'as'   => 'getInAndActive',
			'uses' => 'CateController@getInAndActive'
		]);
		Route::get('update-all', [
			'as'   => 'getUpdateAll',
			'uses' => 'CateController@getUpdateAll'
		]);
	});
	Route::group(['prefix'=>'listing'], function() {
		Route::get('list', [
			'as'   => 'getListingList',
			'uses' => 'ListingController@getList'
		]);
		Route::get('get-listing', [
			'as'   => 'getListing',
			'uses' => 'ListingController@getListing'
		]);
		Route::post('post-listing', [
			'as'   => 'postListing',
			'uses' => 'ListingController@postListing'
		]);
		Route::get('laratables', [
			'as'   => 'laratables',
			'uses' => 'ListingController@getLaraTables'
		]);
		Route::get('tableview', function(){
			return view('admin.listing.demo');
		});
	});
});