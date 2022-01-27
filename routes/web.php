<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Models\Assignment;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
	

	Route::resource('roles', RoleController::class, ['except' => ['show']]);

	Route::resource('user', UserController::class, ['except' => ['show']]);

	Route::resource('groups', GroupController::class, ['except' => ['show']]);

	Route::resource('posts', PostController::class, ['except' => ['show']]);

	Route::resource('quiz', QuizController::class, ['except' => ['show']]);

	Route::resource('assignments', AssignmentController::class);

	Route::resource('feedbacks', FeedbackController::class);

	Route::resource('comments', CommentController::class);

	Route::resource('submissions', SubmissionController::class, ['except' => ['show']]);

	Route::get('groups/{group}/memberlist',['as' => 'groups.memberlist', 'uses' => 'App\Http\Controllers\GroupController@memberlist']);

	Route::get('groups/{group}/convo',['as' => 'groups.convo', 'uses' => 'App\Http\Controllers\GroupController@convo']);

	Route::post('groups/join',['as' => 'groups.join', 'uses' => 'App\Http\Controllers\GroupController@joingroup']);

	Route::get('groups/{group}/assignments',['as' => 'groups.assignments', 'uses' => 'App\Http\Controllers\GroupController@assignments']);

	Route::get('groups/{group}/leave',['as' => 'groups.leave', 'uses' => 'App\Http\Controllers\GroupController@leavegroup']);

	Route::get('quiz/lvl/{lvl}',['as' => 'quiz.display', 'uses' => 'App\Http\Controllers\QuizController@showQuiz']);

	Route::get('assignments/{file_id}/download',['as' => 'assignment.download', AssignmentController::class,'downloadFile']);

	Route::get('submissions/{file_id}/download',['as' => 'submission.download', SubmissionController::class,'downloadFile']);
	Route::get('submissions/{file_id}/downloadReturn',['as' => 'submission.downloadReturn', SubmissionController::class,'downloadReturnFile']);
	Route::get('submissions/{id}/delete',['as' => 'submission.delete', SubmissionController::class,'destroy']);
	Route::get('submissions/{id}/deleteReturn',['as' => 'submission.deleteReturn', SubmissionController::class,'deleteReturn']);
	Route::get('submissions/{id}/return',['as' => 'submission.return', SubmissionController::class,'return']);

	Route::get('assignments/{assignment_id}/submission',[SubmissionController::class,'index']);
	
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	
	Route::get('textbook', function () {
		return view('pages.textbook');
	})->name('textbook');

	Route::get('textbook/t1', function () {
		return view('pages.textbook_t1');
	})->name('textbook_t1');

	Route::get('textbook/t2', function () {
		return view('pages.textbook_t2');
	})->name('textbook_t2');

	Route::get('textbook/t3', function () {
		return view('pages.textbook_t3');
	})->name('textbook_t3');

	Route::get('textbook/t4', function () {
		return view('pages.textbook_t4');
	})->name('textbook_t4');

	Route::get('textbook/t5', function () {
		return view('pages.textbook_t5');
	})->name('textbook_t5');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('joingroup', function () {
		return view('pages.joingroup');
	})->name('joingroup');

	Route::get('table-list', function () {
		return view('pages.tables');
	})->name('table');

	Route::get('logActivity', [App\Http\Controllers\HomeController::class, 'logActivity'])->name('logActivity');
	
});
