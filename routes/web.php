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

Route::get('/', 'TodoList\TodoListController@todoLists');
Route::post('/todo-lists', 'TodoList\TodoListController@addTodoList');
Route::get('/todo-lists/{id}', 'TodoList\TodoListController@manageTodoList');
Route::post('/todo-lists/{id}', 'TodoList\TodoListController@submitManageTodoList');
Route::post('/todo-lists/{id}/delete', 'TodoList\TodoListController@delete');

Route::post('/tasks', 'TodoList\TaskController@addTask');
