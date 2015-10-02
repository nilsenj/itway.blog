<?php



//login/register 3-d party integration Integration
Route::get('auth/login/{provider}', ['as' => 'auth.provider', 'uses' => 'Auth\AuthController@loginThirdParty']);
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);
//search
Route::post('/search', ['as' => 'search', 'uses' => 'SearchController@executeSearch']);
Route::post('/getAllExistingTags', ['as' => 'getAllExistingTags', 'uses' => 'SearchController@getAllExistingTags']);
//end search

// ===============================================
// blog SECTION =================================
// ===============================================
$locale = Request::segment(1);

\Lang::setLocale($locale);

Route::group([ 'prefix' => $locale, 'middleware' => 'locale'], function() {

    Route::post('/language', array(
        'as' => 'language-chooser',
        'uses' => 'LanguageController@chooser'));

    Route::get('/',  [ 'uses' => 'HomeController@index']);

    Route::group(['prefix' => '/', 'as' => 'itway::'], function(){

        Route::group(['prefix' => 'blog', 'as' => 'posts::'], function(){

            Route::get('/', [
                'uses' => 'PostsController@index',
                'as' => 'index'

            ]);
            Route::get('post/{slug}', [
                'uses' => 'PostsController@show',
                'as' => 'show'

            ]);
            Route::get('create', [
                'uses' => 'PostsController@create',
                'as' => 'create'

            ]);

            Route::get('user-posts', [
                'uses' => 'PostsController@userPosts',
                'as' => 'user-posts'

            ]);
            Route::get('edit/{id}', [
                'uses' => 'PostsController@edit',
                'as' => 'edit',
                'middleware' => 'IsUsersOrAdminPost'
            ]);
            Route::patch('update/{id}', [
                'uses' => 'PostsController@update',
                'as' => 'update',
                'middleware' => 'IsUsersOrAdminPost'
            ]);
            Route::delete('delete/{id}', [
                'uses' => 'PostsController@destroy',
                'as' => 'delete',
                'middleware' => 'IsUsersOrAdminPost'
            ]);
            Route::post('store', [
                'uses' => 'PostsController@store',
                'as' => 'store'
            ]);


        });


        Route::group(['prefix' => 'user','middleware' => 'auth', 'as' => 'user::'], function() {

            Route::get('/', [
                'uses' => 'UserController@index',
                'as' => 'index'

            ]);
            Route::get('/{id}', [ 'as' => 'show', 'uses' => 'UserController@show',]);
            Route::get('/settings/{id}', [ 'as' => 'settings', 'uses'=>'UserController@settings', 'middleware' => 'IsUsers']);

            Route::get('create', [
                'uses' => 'UserController@create',
                'as' => 'create'

            ]);
            Route::get('edit/{id}', [
                'uses' => 'UserController@edit',
                'as' => 'edit', 'middleware' => 'IsUsers'
            ]);
            Route::patch('update/{id}', [
                'uses' => 'UserController@update',
//                'middleware' => 'shouldBeUnique',
                'as' => 'update', 'middleware' => 'IsUsers'
            ]);
            Route::delete('{id}', [
                'uses' => 'UserController@destroy',
                'as' => 'delete', 'middleware' => 'IsUsers'
            ]);
            Route::post('store', [
                'uses' => 'UserController@store',
                'as' => 'store', 'middleware' => 'IsUsers'
            ]);
            Route::post('photo', ['uses' => 'UserController@userPhoto','middleware' => 'IsUsers', 'as' => 'photo']);

        });

          });
    Route::group(array('prefix' => 'admin', 'middleware' => ['admin', 'auth'], 'as' => 'admin::'), function () {


        Route::get('/', ['uses' => 'AdminController@index', 'as' => 'dashboard']);

        Route::get('/posts', ['uses' => 'AdminPostsController@index', 'as' => 'post']);

        Route::get('posts/create', function () {
            return view('admin.posts-create');
        });

        Route::group(['prefix' => 'users', 'as' => 'users::'], function() {

            Route::get('/', [
                'uses' => 'AdminUsersController@index',
                'as' => 'index'

            ]);
            Route::get('create', [
                'uses' => 'AdminUsersController@create',
                'as' => 'create'

            ]);
            Route::get('edit/{slug}', [
                'uses' => 'AdminUsersController@edit',
                'as' => 'edit'
            ]);
            Route::patch('update/{id}', [
                'uses' => 'AdminUsersController@update',
                'as' => 'update'
            ]);
            Route::delete('delete/{id}', [
                'uses' => 'AdminUsersController@destroy',
                'as' => 'delete'
            ]);
            Route::post('store', [
                'uses' => 'AdminUsersController@store',
                'as' => 'store'
            ]);
            Route::get('banORunBan/{id}', [
                'uses' => 'AdminUsersController@banORunBan',
                'as' => 'ban'
            ]);

        });
        Route::group(['prefix' => 'posts', 'as' => 'posts::'], function(){

            Route::get('/', [
                'uses' => 'AdminPostsController@index',
                'as' => 'index'

            ]);

            Route::get('edit/{id}', [
                'uses' => 'AdminPostsController@edit',
                'as' => 'edit'
            ]);
            Route::patch('update/{id}', [
                'uses' => 'AdminPostsController@update',
                'as' => 'update'
            ]);
            Route::delete('delete/{id}', [
                'uses' => 'AdminPostsController@destroy',
                'as' => 'delete'
            ]);
            Route::post('store', [
                'uses' => 'AdminPostsController@store',
                'as' => 'store'
            ]);

        });


        Route::group(['prefix' => 'roles', 'as' => 'roles::'], function(){

            Route::get('/', [
                'uses' => 'RolesController@index',
                'as' => 'index'

            ]);
            Route::get('create', [
                'uses' => 'RolesController@create',
                'as' => 'create'

            ]);
            Route::get('edit/{slug}', [
                'uses' => 'RolesController@edit',
                'as' => 'edit'
            ]);
            Route::patch('update/{slug}', [
                'uses' => 'RolesController@update',
                'as' => 'update'
            ]);
            Route::delete('{id}', [
                'uses' => 'RolesController@destroy',
                'as' => 'delete'
            ]);
            Route::post('store', [
                'uses' => 'RolesController@store',
                'as' => 'store'
            ]);

        });


        Route::group(['prefix' => 'permissions', 'as' => 'permissions::'], function(){

            Route::get('/', [
                'uses' => 'PermissionsController@index',
                'as' => 'index'

            ]);
            Route::get('create', [
                'uses' => 'PermissionsController@create',
                'as' => 'create'

            ]);
            Route::get('edit/{slug}', [
                'uses' => 'PermissionsController@edit',
                'as' => 'edit'
            ]);
            Route::patch('update/{slug}', [
                'uses' => 'PermissionsController@update',
                'as' => 'update'
            ]);
            Route::delete('{id}', [
                'uses' => 'PermissionsController@destroy',
                'as' => 'delete'
            ]);
            Route::post('store', [
                'uses' => 'PermissionsController@store',
                'as' => 'store'
            ]);

        });

    });

    Route::get('blog/tags/{slug}', 'PostsController@tags');
    Route::get('user/tags/{slug}', 'UserController@tags');

    Route::get('likeORdis/{class_name}/{object_id}', array('uses' => 'LikeController@likeORdis', 'as' => 'likeORdis'))
        ->where('object_id', '[0-9]+');



// ===============================================
// test SECTION =================================
// ===============================================
});

Route::get('fire', function () {
    // this fires the event
    event(new itway\Events\EventName());
    return "event fired";
});

Route::get('test', function () {
    // this checks for the event
    return view('pages.test');
});

