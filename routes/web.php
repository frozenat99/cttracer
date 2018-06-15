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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [
        'uses'=>'PagesController@index',
    ]
    );

    Route::resource('/accounts', 'AccountController')->parameters([
        'rol' => 'admin_user'
    ]);

    Route::any('/acc-search-results', [
        'uses'=>'AccountController@search'
    ]
    );

    Route::resource('/groups', 'GroupController')->parameters([
        'rol' => 'admin_user'
    ]);

    Route::any('/group-search-results', [
        'uses'=>'GroupController@search'
    ]
    );

    Route::get('/advised-groups', [
        'uses'=>'PagesController@advisedGroups',
    ]
    );

    Route::get('/approve-schedules', [
        'uses'=>'PagesController@approveSchedules',
    ]
    );

   
    Route::resource('/my-project', 'MyProjController')->parameters([
        'rol' => 'admin_user'
    ]);

    Route::resource('/project-search', 'ProjSearchController')->parameters([
        'rol' => 'admin_user'
    ]);
    
    Route::any('/proj-search-results', [
        'uses'=>'ProjSearchController@search'
    ]
    ); 

    Route::resource('/approve-projects', 'ProjAppController')->parameters([
        'rol' => 'admin_user'
    ]);

    Route::any('/app-proj-search-results', [
        'uses'=>'ProjAppController@search'
    ]
    ); 

    Route::get('/schedule-settings', [
        'uses'=>'PagesController@scheduleSettings',
    ]
    );

    Route::get('/search-groups', [
        'uses'=>'PagesController@searchGroups',
    ]
    );

    Route::resource('/stage-settings', 'StageController')->parameters([
        'rol' => 'admin_user'
    ]);

    Route::any('/stage-search-results', [
        'uses'=>'StageController@search'
    ]
    );

    Route::get('/transfer-role', [
        'uses'=>'PagesController@transferRole',
    ]
    );
    
    Route::post('/searchProjects','ProjSearchController@search')->name('searchProj');
});

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
/*
Route::get('/hello', function () {
    // return view('welcome');
    return 'Hello World';
 });

 Route::get('/users/{id}',function($id){
    return 'This is user ' . $id;
});
 */




Auth::routes();


