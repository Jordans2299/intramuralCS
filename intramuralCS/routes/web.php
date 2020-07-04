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

// Route::get('/', function () {
//     //return view('welcome');
//     return 'hello world';
// });

// use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'PagesController@index');

Route::get('/schools', 'PagesController@schools');
Route::get('/courses', 'PagesController@courses');
Route::get('/topics', 'PagesController@courses');
Route::get('/resources', 'PagesController@resources');
Route::put('/profileImg','HomeController@profileImg');
Route::resource('posts', 'PostsController');
Route::get('/blog1','PagesController@blog1');
Route::get('/blog2','PagesController@blog2');
Route::get('/blog3','PagesController@blog3');
Route::get('posts/orderSelect/{order}', ['as'=>'posts.orderSelect','uses'=>'PostsController@orderSelect']);


// Route::get('/create','PostsController@create');
// Route::get('/store','PostsController@store');
// Route::get('/edit','PostsController@edit');
// Route::get('/destroy','PostsController@destroy');
// Route::get('/update','PostsController@update');
//create,store,edit,destroy,update,show
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('comments','CommentsController');
Route::resource('topics','TopicsController');

//likes controller
Route::get('comment/like/{id}', ['as' => 'comment.like', 'uses' => 'LikeController@likeComment']);
Route::get('post/like/{id}', ['as' => 'post.like', 'uses' => 'LikeController@likePost']);

//handles search bar request on forumn/posts page
Route::post('/search',function(){
    $query = Request::get ('query');
    $posts = Post::where('title','LIKE','%'.$query.'%')->orWhere('body','LIKE','%'.$query.'%')->get();
    if(count($posts) > 0){
        return view('posts/index')->withDetails($posts)->withQuery ( $query );
    }
    else {
    return view ('posts/index')->withMessage('No questions with '.$query.' were found!');
    }
});