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

/*use MongoDB\Client as Mongo;
use App\Mongo\Service;

Route::get('mongo', function(Request $request) {
	$service = new Service($uri = null, $uriOptions = [],
            $driverOptions = []);
    $collection = $service->get()->{'laravel-ng2-vue'}->quotes;
    return $collection->find()->toArray();
});*/

Route::get('/', function () {
    return view('welcome');
});