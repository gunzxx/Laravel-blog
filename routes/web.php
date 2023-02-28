<?php

use App\Models\Categories;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardPostController;

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

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home',[
        'title' => 'Home',
        'nama' => 'Guntur'
    ]);
})->name('home');

Route::get('/about', function () {
    return view('about',['title' => 'About']);
});

Route::get('/blog', [PostsController::class,'index']);
Route::get('/blog/search', [PostsController::class,'index']);
Route::get('/blog/post/{slug}', [PostsController::class,'single']);

Route::get('/blog/category',[function(){
    return view('categories',[
        'title'=>"Post Categories",
        'categories'=>Categories::limit(10)->get(),
        'active'=>'category',
    ]);
}]);

Route::get('/login', [LoginController::class,'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class,'authenticate']);
Route::post('/logout', [LoginController::class,'logout'])->middleware('auth');

Route::get('/register', [RegisterController::class,'index'])->middleware('guest');
Route::post('/register', [RegisterController::class,'store']);

Route::get('/dashboard', fn() => view('dashboard.index',['title'=>'Dashboard',]))->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth')->except(['checkSlug']);


Route::resource('/dashboard/categories', AdminCategoryController::class);



Route::get('tes',function(){
    return view('tes',[
        'article'=>Tes::all()->last()->getMedia('image'),
    ]);
});

Route::post('add',function(){
    try{
        Tes::create()
        ->addMediaFromRequest('image')
        ->preservingOriginal()
        ->toMediaCollection();
        echo "OKE";
    }catch(\Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded $e){
        Tes::all()->last()->delete();
        dd($e);
    }
});

Route::get('add',function(){
    try{
        $tes = Tes::create();

        $tes->addMedia(storage_path('tes.jpg'))
        ->preservingOriginal()
        ->toMediaCollection('image');

        $tes->addMedia(storage_path('tes.jpg'))
        ->preservingOriginal()
        ->toMediaCollection('image');
    }catch(\Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded $e){
        Tes::all()->last()->delete();
        dd($e);
    }
});

Route::get('del',function(){
    Tes::all()->last()->delete();
});