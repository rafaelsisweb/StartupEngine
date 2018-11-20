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

//Analytics
Route::get('/analytics/events/{type}', 'APIController@getEvents');
Route::get('/analytics/events/{type}/{key}', 'APIController@getEventsWithKey');
Route::get('/analytics/events/{type}/{key}/{value}', 'APIController@getEventsByKeyAndValue');
Route::get('/analytics/event/', 'APIController@saveEvent');
Route::post('/analytics/event/', 'APIController@saveEvent');

//Pages
Route::get('/page/{slug}', 'APIController@getPage');
Route::get('/page/{slug}/random', 'APIController@getRandomPageVariation');
Route::get('/random/', 'APIController@getRandomItem');

//Content
Route::get('content/item', 'APIController@getItem');
Route::get('content/items', 'APIController@getItems');

//Search
Route::get('/search/', 'APIController@search');

//Stripe
Route::get('stripe/products/', 'APIController@getStripeProducts');
Route::get('stripe/new/product/', 'APIController@createProduct');
Route::post('stripe/new/product/', 'APIController@createProduct');
Route::get('stripe/new/product/plan', 'APIController@createProductPlan');
Route::post('stripe/new/product/plan', 'APIController@createProductPlan');
Route::get('subscriptions/create', 'APIController@createSubscription');
Route::get('stripe/plans/', 'APIController@getStripePlans');
Route::get('invoices/user/{id}', 'APIController@getInvoices');

//Github
Route::get('repo/github/json/{filepath?}', 'GithubController@json')->where('filepath', '(.*)');
Route::get('repo/github/raw/{filepath?}', 'GithubController@raw')->where('filepath', '(.*)');
Route::get('repo/github/info/{filepath?}', 'GithubController@info')->where('filepath', '(.*)');

//Modules
foreach (Module::enabled() as $module){
    $file = '/app/Modules/'.$module['name'].'/Http/Routes/api.php';
    if (file_exists($file)){
        include $file;
    }
}