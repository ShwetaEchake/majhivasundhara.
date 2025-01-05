<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
})->name('/');

Route::get('404', function () {

    $authUser = auth()->user();

    if($authUser)
    {
        if( $authUser->hasRole(['Field Accessor']) )
            return redirect()->back();
    }

    return view('errors.404');
})->name('404');


// Guest Users
Route::middleware(['guest','PreventBackHistory'])->group(function()
{
    Route::get('login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'] )->name('login');
    Route::post('login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('signin');
    Route::get('register', [App\Http\Controllers\Admin\AuthController::class, 'showRegister'] )->name('register');
    Route::post('register', [App\Http\Controllers\Admin\AuthController::class, 'register'])->name('signup');
    Route::get('forget-password', [App\Http\Controllers\Admin\AuthController::class, 'forgetPassword'] )->name('forget-password');

});



// Authenticated users
Route::middleware(['auth','PreventBackHistory'])->group(function()
{

    // Auth Routes
    Route::get('edit-profile', [App\Http\Controllers\Admin\DashboardController::class, 'editProfile'] )->name('edit-profile');
    Route::get('home', fn () => redirect()->route('dashboard'))->name('home');
    Route::post('logout', [App\Http\Controllers\Admin\AuthController::class, 'Logout'])->name('logout');
    Route::get('marks', [App\Http\Controllers\Admin\DashboardController::class, 'marks'])->name('marks');
    Route::get('show-change-password', [App\Http\Controllers\Admin\AuthController::class, 'showChangePassword'] )->name('show-change-password');
    Route::post('change-password', [App\Http\Controllers\Admin\AuthController::class, 'changePassword'] )->name('change-password');



    // Dashboard routes
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');



    // Masters routes
    Route::resource('departments', App\Http\Controllers\Admin\Masters\DepartmentController::class );
    Route::resource('wards', App\Http\Controllers\Admin\Masters\WardController::class );
    Route::resource('questions', App\Http\Controllers\Admin\QuestionController::class );
    Route::resource('contest_two_quests', App\Http\Controllers\Admin\ContestTwoQuestionController::class );



    // Users Roles n Permissions
    Route::resource('users', App\Http\Controllers\Admin\UserController::class );
    Route::get('users/{user}/toggle', [App\Http\Controllers\Admin\UserController::class, 'toggle' ])->name('users.toggle');
    Route::put('users/{user}/change-password', [App\Http\Controllers\Admin\UserController::class, 'changePassword' ])->name('users.change-password');
    Route::get('users/{user}/get-role', [App\Http\Controllers\Admin\UserController::class, 'getRole' ])->name('users.get-role');
    Route::put('users/{user}/assign-role', [App\Http\Controllers\Admin\UserController::class, 'assignRole' ])->name('users.assign-role');
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class );



    // Contestents Routes
    Route::resource('contestents', App\Http\Controllers\Admin\ContestentController::class );
    Route::get('forms/category/{category?}/{page_type}', [App\Http\Controllers\Admin\FormController::class, 'index'] )->name('forms.index');
    Route::get('view_form/{user}', [App\Http\Controllers\Admin\FormController::class, 'viewForm'] )->name('view_form');
    Route::get('view_pd/{user}', [App\Http\Controllers\Admin\FormController::class, 'viewPd'] )->name('view_pd');
    Route::get('user_form_edit/{user_contest}', [App\Http\Controllers\Admin\FormController::class, 'editForm'] )->name('user-form.edit');
    Route::put('user_form/{user_contest}', [App\Http\Controllers\Admin\FormController::class, 'updateForm'] )->name('user-form.update');



    // Janjagruti Competition Routes
    Route::get('contest-form-two', [App\Http\Controllers\Admin\JanjagrutiController::class, 'index'] )->name('contest-form-two.index');
    Route::get('view_form_two/{user}', [App\Http\Controllers\Admin\JanjagrutiController::class, 'viewForm'] )->name('view_form_two');
    Route::get('user_form_two_edit/{user_contest}', [App\Http\Controllers\Admin\JanjagrutiController::class, 'editForm'] )->name('user-form-two.edit');
    Route::put('user_form_two/{user_contest}', [App\Http\Controllers\Admin\JanjagrutiController::class, 'updateForm'] )->name('user-form-two.update');



    // Admin side field marks edit
    Route::put('paryavaran_field_marks/{contest}', [App\Http\Controllers\Admin\FormController::class, 'paryavaranFieldMarks'])->name('paryavaran_field_marks.update');
    Route::put('janjagruti_field_marks/{contest}', [App\Http\Controllers\Admin\JanjagrutiController::class, 'janjagrutiFieldMarks'])->name('janjagruti_field_marks.update');



    // Frontend Routes
    Route::resource('contests', App\Http\Controllers\Frontend\ContestController::class );
    Route::get('contest/paryavaran-dut', [App\Http\Controllers\Frontend\ContestController::class, 'paryavaranDutForm'] )->name('contests.paryavaran-dut');
});



Route::prefix('field')->name('field.')->group(function(){

    // Guest Field Users
    Route::middleware(['guest','PreventBackHistory'])->group(function()
    {
        Route::get('/', [App\Http\Controllers\Field\AuthController::class, 'showLogin'] )->name('/');
        Route::get('login', [App\Http\Controllers\Field\AuthController::class, 'showLogin'] )->name('login');
        Route::post('login', [App\Http\Controllers\Field\AuthController::class, 'login'])->name('signin');
    });


    // Authenticated Field Users
    Route::middleware(['auth','PreventBackHistory'])->group(function()
    {

        Route::post('logout', [App\Http\Controllers\Field\AuthController::class, 'Logout'])->name('logout');

        // Dashboard routes
        Route::get('home', [App\Http\Controllers\Field\DashboardController::class, 'index'])->name('home');
        Route::get('dashboard', [App\Http\Controllers\Field\DashboardController::class, 'index'])->name('dashboard');


        // Ward wise forms
        Route::get('ward-forms/{ward}', [App\Http\Controllers\Field\WardFormController::class, 'index'])->name('ward.forms');
        Route::get('paryavaran_form_view/{user}', [App\Http\Controllers\Field\WardFormController::class, 'viewParyavaranForm'])->name('paryavaran_form.view');
        Route::get('paryavaran_form_edit/{contest}', [App\Http\Controllers\Field\WardFormController::class, 'editParyavaranForm'])->name('paryavaran_form.edit');
        Route::put('paryavaran_form_update/{contest}', [App\Http\Controllers\Field\WardFormController::class, 'updateParyavaranForm'])->name('paryavaran_form.update');
        Route::get('paryavaran_form_final_submit/{user}', [App\Http\Controllers\Field\WardFormController::class, 'finalSubmitParyavaranForm'])->name('paryavaran_form.final-submit');


        Route::get('paryavaran_dut_form_view/{user}', [App\Http\Controllers\Field\WardFormController::class, 'viewParyavaranDutForm'])->name('paryavaran_dut_form.view');
        Route::get('paryavaran_dut_form_edit/{contestent_pd}', [App\Http\Controllers\Field\WardFormController::class, 'editParyavaranDutForm'])->name('paryavaran_dut_form.edit');
        Route::put('paryavaran_dut_form_update/{contestent_pd}', [App\Http\Controllers\Field\WardFormController::class, 'updateParyavaranDutForm'])->name('paryavaran_dut_form.update');


        Route::get('janjagruti_form_view/{user}', [App\Http\Controllers\Field\WardFormController::class, 'viewJanjagrutiForm'])->name('janjagruti_form.view');
        Route::get('janjagruti_form_edit/{contest}', [App\Http\Controllers\Field\WardFormController::class, 'editJanjagrutiForm'])->name('janjagruti_form.edit');
        Route::put('janjagruti_form_update/{contest}', [App\Http\Controllers\Field\WardFormController::class, 'updateJanjagrutiForm'])->name('janjagruti_form.update');
        Route::get('janjagruti_form_final_submit/{user}', [App\Http\Controllers\Field\WardFormController::class, 'finalSubmitJanjagrutiForm'])->name('janjagruti_form.final-submit');
    });

});




Route::get('/php', function(Request $request){
    if( !auth()->check() )
        return 'Unauthorized request';

    Artisan::call($request->artisan);
    return dd(Artisan::output());
});


Route::get('/test-code', function(){
    DB::table('app_employees')->orderBy('id')->chunk(200, function($users){
        foreach($users as $user)
        {
            DB::table('app_users')->where('id', $user->user_id)->update(['ward_id'=> $user->ward_id]);
        }
    });

    return 'done';
});
