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
Route::post('nicepay-dbprocess', 'Front\NicepayController@dbProcess');
// Route::post('nicepay-callback', 'Front\NicepayController@callback');
Route::get('get-calling-code/{id}', 'Front\GeneralController@getCallingCode');

// Route::group(['middleware' => 'cors'], function () {
//     Route::get('nicepay-callback', 'Front\NicepayController@dbProcess');
// });

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logoutAPI');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');
});

Route::get('/recommended-products', 'Api\ApiController@recommendedProduct');
Route::get('/blogs', 'Api\ApiController@getBlogs');

Route::get('/products', [
    'as' => 'api.search',
    'uses' => 'Api\ApiController@retrieveProducts'
]);

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@loginAPI');
    Route::post('register', 'Auth\RegisterController@registerAPI');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});
