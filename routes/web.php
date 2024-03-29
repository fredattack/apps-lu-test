<?php
    
    use App\Http\Controllers\GetTagsControllerForSelectController;
    use App\Http\Controllers\NewsController;
    use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource ( 'news' , NewsController::class)->except ( ['create','show']);

Route::get('news-undo-delete/{id}',[NewsController::class,'undoDelete'])->name('news.undo-delete');

Route::get('tags-select',GetTagsControllerForSelectController::class);

