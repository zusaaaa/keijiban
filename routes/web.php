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

//トップページ
Route::get('/', "ArticleController@showList")->name("toppage");

//記事詳細画面の表示
Route::get('/article/{id}', "ArticleController@showDetail")->name("show");

Auth::routes();

//仮登録
Route::post('register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');

//本登録及び登録完了
Route::get('register/verify/{token}', 'Auth\RegisterController@showForm');

//ログイン画面の表示
Route::get('/signup', "UserController@getSignup")->name("signup");

//新規会員の登録
Route::post('/signup', "UserController@postSignup")->name("signup");
