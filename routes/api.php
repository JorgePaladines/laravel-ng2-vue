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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

/*use MongoDB\Client as Mongo;
use App\Mongo\Service;

Route::get('/mongo', function(Request $request) {
	$service = new Service($uri = null, $uriOptions = [],
            $driverOptions = []);
    $collection = $service->get()->{'laravel-ng2-vue'}->quotes;
    return $collection->find()->toArray();
});*/

Route::get('/quotes', [
   'uses' => 'QuoteController@getQuotes'
]);

Route::post('/quote', [
    'uses' => 'QuoteController@postQuote'
]);
Route::put('/quote/{id}', [
    'uses' => 'QuoteController@putQuote'
]);
Route::delete('/quote/{id}', [
    'uses' => 'QuoteController@deleteQuote'
]);

/*
Route::get('/quotes', 'QuoteController@index');
Route::get('/quotes/{id}', 'QuoteController@show');
Route::post('/quotes', 'QuoteController@store');
Route::post('/quotes/{id}', 'QuoteController@update');
Route::delete('/quotes/{id}', 'QuoteController@destroy');
Route::delete('/quotes/{id}/answers', 'QuoteController@resetAnswers');
*/