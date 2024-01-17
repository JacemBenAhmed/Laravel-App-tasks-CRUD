<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthManager ;
use App\Http\Controllers\Todocontroller ;








Route::get('/', function () {
    return view('index');
})->name('home');


Route::get('/contact', function () {
    return view('contact');
});



Route::get('/login', [AuthManager::class , 'login'])->name('login');
Route::get('/register', [AuthManager::class ,'register'])->name('register');

Route::post('login',[AuthManager::class , 'loginPost'])->name('login.post') ;
Route::post('register',[AuthManager::class , 'registerPost'])->name('register.post') ;

Route::get('logout',[AuthManager::class ,'logout'])->name('logout') ;

Route::get('todos/index',[Todocontroller::class , 'index'])->name('todos.index') ;

Route::get('todos/create',[Todocontroller::class , 'create'])->name('todos.create') ;
Route::post('todos/store',[Todocontroller::class , 'store'])->name('todos.store') ;
Route::get('todos/show/{id}',[Todocontroller::class , 'show'])->name('todos.show') ;

Route::get('todos/{id}/edit',[Todocontroller::class , 'edit'])->name('todos.edit') ;

Route::put('todos/update',[Todocontroller::class , 'update'])->name('todos.update') ;
Route::delete('todos/destroy',[Todocontroller::class , 'destroy'])->name('todos.destroy') ;


