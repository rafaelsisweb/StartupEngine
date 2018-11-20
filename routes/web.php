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

use Caffeinated\Modules\Facades\Module;

Auth::routes();

//Products & Services
Route::get('/subscribe/{id}', 'SubscriptionController@confirmSubscription');
Route::get('/subscription/submit/', 'SubscriptionController@submitSubscription');
Route::post('/subscription/submit/', 'SubscriptionController@submitSubscription');

Route::group(['middleware' => ['permission:view backend', 'backend']], function () {

    //App
    Route::get('/app', 'AppController@index');

    //Profile
    Route::group(['middleware' => ['role:staff']], function () {
        Route::get('/app/dashboard', 'AppController@index');
        Route::get('/app/profile', 'ProfileController@index');
        Route::get('/app/edit/profile', 'ProfileController@editProfile');
        Route::post('/app/edit/profile', 'ProfileController@saveProfile');
    });

    //Schema
    Route::group(['middleware' => ['permission:edit content types']], function () {
        Route::get('/app/schema', 'SchemaController@index');
        Route::get('/app/new/schema', 'SchemaController@addSchema');
        Route::post('/app/new/schema', 'SchemaController@saveSchema');
        Route::get('/app/edit/schema/{slug}', 'SchemaController@editSchema');
        Route::post('/app/edit/schema/{slug}', 'SchemaController@saveSchema');
    });

    //Settings
    Route::group(['middleware' => ['permission:edit settings']], function () {
        Route::get('/app/settings', 'SettingController@index');
        Route::get('/app/new/setting', 'SettingController@addSetting');
        Route::get('/app/edit/setting/{id}', 'SettingController@editSetting');
        Route::post('/app/edit/setting', 'SettingController@saveSetting');
    });
    //API Settings
    Route::group(['middleware' => ['permission:manage api settings']], function () {
        Route::get('/app/settings/api', 'AppController@api');
    });

    //Pages
    Route::group(['middleware' => ['permission:edit pages']], function () {
        Route::get('/app/pages', 'PageController@index');
        Route::get('/app/new/page', 'PageController@addPage');
        Route::get('/app/edit/page/{id}', 'PageController@editPage');
        Route::post('/app/edit/page', 'PageController@savePage');
        Route::get('/app/delete/page/{id}', 'PageController@deletePage');
    });

    //Users
    Route::group(['middleware' => ['permission:edit users']], function () {
        Route::get('/app/users', 'UserController@index');
        Route::get('/app/new/user', 'UserController@newUser');
        Route::post('/app/new/user', 'UserController@saveUser');
        Route::get('/app/view/user/{id}', 'UserController@viewUser');
        Route::get('/app/edit/user/{id}', 'UserController@editUser');
        Route::post('/app/edit/user', 'UserController@saveUser');
        Route::get('/app/delete/user/{id}', 'UserController@deleteUser');
    });

    //Roles
    Route::group(['middleware' => ['permission:browse roles']], function () {
        Route::get('/app/roles', 'RoleController@index');
        Route::get('/app/new/role', 'RoleController@addRole');
        Route::get('/app/edit/role/{id}', 'RoleController@edit');
        Route::post('/app/edit/role', 'RoleController@saveRole');
        Route::post('/app/new/role', 'RoleController@saveRole');
    });

    //Permissions
    Route::group(['middleware' => ['permission:edit permissions']], function () {
        Route::get('/app/permissions', 'PermissionController@index');
        Route::get('/app/new/permission', 'PermissionController@addPermission');
        Route::post('/app/new/permission', 'PermissionController@savePermission');
    });

    //Demographics
    Route::group(['middleware' => ['permission:edit users']], function () {
        Route::get('/app/demographics', 'DemographicController@index');
        Route::get('/app/new/demographic', 'DemographicController@addDemographic');
        Route::post('/app/new/demographic', 'DemographicController@saveDemographic');
        Route::get('/app/edit/demographic/{id}', 'DemographicController@editDemographic');
        Route::post('/app/edit/demographic', 'DemographicController@saveDemographic');
        Route::get('/app/delete/demographic/{id}', 'DemographicController@deleteDemographic');
    });

    //Content
    Route::group(['middleware' => ['permission:browse posts|browse own posts']], function () {
        Route::get('/app/tags', 'TagController@index');
        Route::get('/app/content', 'PostController@index');
        Route::get('/app/new/{slug}', 'PostController@addPost');
        Route::post('/app/new/post', 'PostController@savePost');
        Route::get('/app/view/post/{id}', 'PostController@viewPost');
        Route::get('/app/edit/post/{id}', 'PostController@editPost');
        Route::get('/app/delete/post/{id}', 'PostController@deletePost');
        Route::post('/app/edit/post', 'PostController@savePost');
    });

    //Brand
    Route::group(['middleware' => ['permission:edit settings']], function () {
        Route::get('/app/brand', 'BrandController@index');
    });

    //Analytics
    Route::group(['middleware' => ['permission:view analytics']], function () {
        Route::get('/app/analytics', 'AnalyticsController@index');
        Route::get('/app/analytics/mixpanel', 'AnalyticsController@mixpanel');
    });

    //Packages
    Route::group(['middleware' => ['permission:edit packages']], function () {
        Route::get('/app/packages', 'PackageController@index');
        Route::post('/app/new/package', 'PackageController@savePackage');
        Route::get('/app/delete/package/{id}', 'PackageController@deletePackage');
        Route::get('/app/update/package/{id}', 'PackageController@updatePackage');
        Route::get('/app/reset/package/{id}', 'PackageController@resetPackage');
    });

    //Products & Services
    Route::group(['middleware' => ['permission:edit settings']], function () {
        Route::get('/app/subscriptions', 'SubscriptionController@index');
        Route::get('/app/products', 'ProductController@index');
        Route::post('/app/edit/product/', 'ProductController@saveProduct');
        Route::post('/app/edit/product/plan', 'ProductController@saveProductPlan');
        Route::get('/app/view/subscription/{id}', 'SubscriptionController@viewSubscription');
        Route::get('/app/view/subscription/{id}/plan/{plan}', 'SubscriptionController@viewSubscriptionPlan');
        Route::get('/app/new/subscription/{id}/plan', 'SubscriptionController@newSubscriptionPlan');
        Route::post('/app/new/subscription/plan', 'SubscriptionController@newSubscriptionPlan');
        Route::post('/app/new/subscription', 'SubscriptionController@saveSubscription');
        Route::get('/app/delete/subscription/{id}', 'SubscriptionController@deleteSubscription');
        Route::get('/app/update/subscription/{id}', 'SubscriptionController@updateSubscription');
        Route::get('/app/reset/subscription/{id}', 'SubscriptionController@resetSubscription');
    });

    //Social
    Route::group(['middleware' => ['permission:edit posts']], function () {
        Route::get('/app/social/platforms', 'PlatformController@index');
        Route::get('/app/new/social/platform', 'PlatformController@newSocialPlatform');
        Route::post('/app/new/social/platform', 'PlatformController@saveSocialPlatform');
        Route::get('/app/social/', 'SocialMediaController@index');
        Route::get('/app/edit/social/post/{id}', 'SocialMediaController@viewSocialPost');
        Route::post('/app/edit/social/platform', 'PlatformController@saveSocialPlatform');
    });

});

//Modules
foreach (Module::enabled() as $module){
    $file = '/app/Modules/'.$module['name'].'/Http/Routes/web.php';
    if (file_exists($file)){
        include $file;
    }
}

//Web Middleware
Route::group(['middleware' => ['web']], function () {

    Route::get('/content/{slug}', 'PostController@getItem');
    Route::get('/content/tag/{tag}', 'PostController@getItemsByTag');
    Route::get('/content/{postType}/{tag}', 'PostController@getPostByPostTypeAndSlug');

    //Auth
    Route::get('/login', 'AppController@login')->name('login');
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::get('/register', ['uses' => '\App\Http\Controllers\Auth\LoginController@logout', 'as' => 'page']);
    Route::get('/app/login', 'AppController@login');

    //Pages
    Route::get('/', 'PageController@getHomepage')->name('home');
    Route::get('/home', 'PageController@getHomepage');
    Route::get('/{slug}', 'PageController@getPage');

});
