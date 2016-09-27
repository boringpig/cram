<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//前端頁面Routes
Route::get('/', ['as' => 'home', 'uses' => 'PageController@getHomePage']);
Route::get('api/calendar', ['uses' => 'CalendarEventController@ajax_showAllEvent']);
Route::resource('article', 'ArticleController');

//各班級介紹
Route::get('lesson/elementary', ['as' => 'lesson.elementary', 'uses' => 'LessonController@getElementaryPage']);
Route::get('lesson/junior', ['as' => 'lesson.junior', 'uses' => 'LessonController@getJuniorPage']);
Route::get('lesson/senior', ['as' => 'lesson.senior', 'uses' => 'LessonController@getSeniorPage']);

//聯絡我們Routes
Route::get('contact', ['as' => 'contact.index', 'uses' => 'MessageController@getContactPage']);
Route::post('contact-send', ['as' => 'contact.send', 'uses' => 'MessageController@postContactPage']);
Route::get('contact/record', ['as' => 'contact.record', 'uses' => 'MessageController@getContactRecord']);
Route::get('contact/show/{id}', ['as' => 'contact.show', 'uses' => 'MessageController@getShowContact']);
Route::post('contact/replay', ['as' => 'contact.replay', 'uses' => 'MessageController@postReplayContact']);
Route::post('contact/upload-img', ['as' => 'contact.upload', 'uses' => 'MessageController@postUploadImage']);

//應用程式登入Routes
Route::get('auth/social/login/{provider?}',['as' => 'auth.getSocialAuth', 'uses' => 'Auth\SocialController@getSocialAuth']);
Route::get('auth/social/login/callback/{provider?}',['as' => 'auth.getSocialAuthCallback', 'uses' => 'Auth\SocialController@getSocialAuthCallback']);
//登入Routes
Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
//註冊Routes
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
//忘記密碼Routes
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// 使用者帳戶Routes
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function(){
	Route::get('/edit', ['as' => 'user.profile', 'uses' => 'UserController@getEditUser']);
	Route::post('/{id}/edit', ['as' => 'edit.user.profile', 'uses' => 'UserController@postEditUser']);
	Route::get('/account/change_password', ['as' => 'user.password', 'uses' => 'UserController@getChangePassword']);
	Route::post('/account/change_password', ['as' => 'change.user.password', 'uses' => 'UserController@postChangePassword']);
	Route::get('/account/activity-log', ['as' => 'user.activity-log', 'uses' => 'UserController@getUserActivityLog']);
	Route::post('/account/user-avatar', ['as' => 'user.avatar', 'uses' => 'UserController@postUserAvatar']);
});

// 上班打卡Routes
Route::group(['prefix' => 'clock', 'middleware' => ['auth','role:工讀生|系統開發員']], function(){
	Route::get('/log', ['as' => 'user-clock.log', 'uses' => 'UserController@getClockLog']);
	Route::get('/view', ['as' => 'user-clock.view', 'uses' => 'UserController@getClockView']);
	Route::post('/view/month', ['as' => 'user-clock.month', 'uses' => 'UserController@ajax_postClockMonth']);
	Route::get('/', ['as' => 'clock-in.index', 'uses' => 'UserController@getClockIndex']);
	Route::get('/work', ['as' => 'clock-in.manage', 'uses' => 'UserController@getClockStatus']);
	Route::post('/work/in', ['as' => 'clock-in.work', 'uses' => 'UserController@postUserClockIn']);
	Route::post('/work/out', ['as' => 'clock-out.work', 'uses' => 'UserController@postUserClockOut']);
	Route::post('/work/finish', ['as' => 'clock-out.finish', 'uses' => 'WorkController@postUserWork']);
	Route::get('/work/content', ['as' => 'work.content', 'uses' => 'WorkController@ajax_showAllWork']);
});

//班級點名Routes
Route::group(['prefix' => 'rollCall', 'middleware' => ['auth','role:工讀生|系統開發員']], function(){
	Route::get('/', ['as' => 'rollCall.index', 'uses' => 'RollCallController@getRollCallIndex']);
	Route::post('/search-lesson', ['as' => 'search.lesson', 'uses' => 'RollCallController@ajax_postSearchLesson']);
	Route::post('/lesson', ['as' => 'rollCall.lesson', 'uses' => 'RollCallController@ajax_postRollCallLesson']);
});

///後台管理Routes
Route::group(['prefix' => 'backend', 'namespace' => 'Admin'], function(){
	//首頁Routes
	Route::get('/', ['as' => 'backend.home', 'uses' => 'DashboardController@getIndex']);
	/**** 使用者管理Routes ****/
	//人事管理
	Route::get('/users/log', ['as' => 'backend.users.log', 'uses' => 'UserController@getAllUserActivityLog']);
	Route::resource('/users', 'UserController');
	//角色管理
	Route::resource('/roles', 'RoleController');
	//角色權限管理
	Route::resource('/permissions', 'PermissionController');
	/**** 工讀生管理Routes ****/
	//人事管理
	Route::get('servitor', ['as' => 'servitor-clock.view', 'uses' => 'ServitorController@getClockView']);
	Route::post('/servitor/month', ['as' => 'servitor-clock.month', 'uses' => 'ServitorController@ajax_postClockMonth']);
	Route::resource('/servitors', 'ServitorController');
	//工作管理
	Route::get('work', ['as' => 'backend.work', 'uses' => 'WorkController@manageWork']);
	Route::resource('/works', 'WorkController');

	/**** 班級管理Routes ****/
	//班級管理
	Route::resource('/lessons', 'LessonController');
	//年級管理
	Route::get('/grade', ['as' => 'backend.grade', 'uses' => 'GradeController@manageGrade']);
	Route::resource('/grades', 'GradeController');
	//上課時間管理
	Route::get('/time', ['as' => 'backend.time', 'uses' => 'TimeController@manageTime']);
	Route::resource('/times', 'TimeController');
	//點名管理
	Route::get('rollCall/date', ['as' => 'rollCall-date.view', 'uses' => 'RollCallController@getRollCallViewDate']);
	Route::post('rollCall/date', ['as' => 'rollCall.date', 'uses' => 'RollCallController@ajax_searchRollCallDate']);
	Route::get('rollCall/lesson', ['as' => 'rollCall-lesson.view', 'uses' => 'RollCallController@getRollCallViewLesson']);
	Route::post('rollCall/lesson', ['as' => 'rollCall.lesson', 'uses' => 'RollCallController@ajax_searchRollCallLesson']);
	Route::get('rollCall/show/{id}', ['as' => 'rollCall.show', 'uses' => 'RollCallController@showRollCall']);
	Route::post('rollCall/update/{id}', ['as' => 'rollCall.update', 'uses' => 'RollCallController@postUpdateRollCall']);

	/**** 學生管理Routes ****/
	Route::resource('/students', 'StudentController');

	/**** 公告管理Routes ****/
	//公告文章管理
	Route::resource('/articles', 'ArticleController');
	//類別管理
	Route::get('/category', ['as' => 'backend.category' , 'uses' => 'CategoryController@manageCategory']);
	Route::resource('/categories', 'CategoryController');
	//標籤管理
	Route::get('/tag', ['as' => 'backend.tag', 'uses' => 'TagController@manageTag']);
	Route::resource('/tags', 'TagController');

	/**** 行事曆管理Routes ****/
	Route::resource('/calendar_events', 'CalendarEventController');
});

