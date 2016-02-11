<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('welcome');
});



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::get('/', 'loginController@home');

    Route::get('/login', 'loginController@logIn' );
    Route::post('/login', 'loginController@verifyLogIn' );
    Route::get('/logout', 'loginController@logOut' );

    Route::get('/register', 'loginController@registerPage' );
    Route::post('/register', 'loginController@verifyRegisterPage' );

    Route::get('/verify', 'loginController@verifyPage' );
    Route::post('/verify', 'loginController@verifyVerifyPage' );

    Route::get('/verifyMail', 'loginController@verifyMail' );
    Route::post('/verifyMail', 'loginController@verifyMailPost' );

    Route::get('/forgotPassword', 'loginController@forgotPassword' );
    Route::post('/forgotPassword', 'loginController@forgotPasswordPost' );
    Route::get('/forgotPasswordMail', 'loginController@forgotPasswordMail' );
    Route::post('/forgotPasswordMail', 'loginController@forgotPasswordMailPost' );

    Route::get('/admin/dashboard', 'adminPagesController@home' );

    Route::get('/admin/users/manage', 'adminPagesController@manageUser' );
    Route::get('/admin/users/edit/{id}', 'adminPagesController@editUser' );
    Route::post('/admin/users/edit/{id}', 'adminPagesController@editUserPost' );
    Route::get('/admin/users/add', 'adminPagesController@addUser' );
    Route::post('/admin/users/add', 'adminPagesController@addUserPost' );
    Route::get('/admin/users/delete/{id}', 'adminPagesController@deleteUser');

    Route::get('/admin/categories/manage', 'categoriesController@manageCategory' );
    Route::get('/admin/categories/edit/{id}', 'categoriesController@editCategory' );
    Route::post('/admin/categories/edit/{id}', 'categoriesController@editCategoryPost' );
    Route::post('/admin/categories/update', 'categoriesController@updateCategoryPost' );

    /*Route::get('/admin/categories/add', 'categoriesController@addCategory' );
    Route::post('/admin/categories/add', 'categoriesController@addCategoryPost' );
    Route::get('/admin/categories/delete/{id}', 'categoriesController@deleteCategory');*/

    Route::get('/user/uploads/types', 'userPagesController@types' );
    Route::post('/user/uploads/types', 'userPagesController@typesPost' );
    Route::get('/user/uploads', 'userPagesController@uploads' );

    Route::get('/user/dashboard', 'userPagesController@home' );

    /*Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);*/

});
