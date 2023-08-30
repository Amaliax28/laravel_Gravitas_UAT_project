<?php

use App\Models\Project;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TesterController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\TestCaseController;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Controllers\ImportExportController;

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

// All Projects
Route::get('/',[ProjectController::class,'index'])->middleware('auth');
// All Projects
Route::get('/all-projects',[ProjectController::class,'index'])->middleware('auth');

// Store New Project Data
Route::post('/projects',[ProjectController::class,'store'])->middleware('auth');

// Show My Projects
Route::get('/my-projects', [ProjectController::class,'MyProjects'])->middleware('auth');

// Update Project
Route::put('projects/{project}',[ProjectController::class,'update'])->middleware('auth');

// Delete Project
Route::delete('projects/{project}',[ProjectController::class,'destroy'])->middleware('auth');

// Show Sessions
Route::get('/project/{project}/sessions', [SessionController::class,'index'])->middleware('auth');

// Store New Session Data
Route::post('/project/{project}/sessions/create',[SessionController::class,'store'])->middleware('auth');

// Update Session Data
Route::put('/project/{project}/sessions/{session}',[SessionController::class,'update'])->middleware('auth');

// Delete Session
Route::delete('sessions/{project}/{session}',[SessionController::class,'destroy'])->middleware('auth');

// Show testers
Route::get('/project/{project}/session/{session}/testers', [TesterController::class,'index'])->middleware('auth');

// Show tester without sessions
Route::get('/project/{project}/testers', [TesterController::class,'showTestersWithoutSession'])->middleware('auth');

// Remove Testers
Route::delete('/project/{project}/tester/{user}/remove',[TesterController::class,'destroy'])->middleware('auth');


// Show all test cases
Route::get('/project/{project}/session/{session}', [TestCaseController::class,'index'])->middleware('auth');

// Show test case
Route::get('/project/{project}/session/{session}/tester/{tester}', [TestCaseController::class,'show'])->middleware('auth');

// Show Create Test Case Form
Route::get('/project/{project}/session/{session}/testcase/create',[TestCaseController::class,'create'])->middleware('auth');

// Store Test Case Data
Route::post('/project/{project}/session/{session}/testcases',[TestCaseController::class,'store'])->middleware('auth');

// Show Edit Test Case Form to Update
Route::get('/project/{project}/session/{session}/edit',[TestCaseController::class,'edit'])->middleware('auth');

// Update Test Case
Route::put('/project/{project}/session/{session}/testcase/{testCase}',[TestCaseController::class,'update'])->middleware('auth');

// Delete Test Case
Route::delete('/project/{project}/session/{session}/testcase/{testCase}/delete',[TestCaseController::class,'destroy'])->middleware('auth');


// Show Response Form
Route::get('/project/{project}/session/{session}/testcase/',[ResponseController::class,'create'])->middleware('auth');

// Submit Response
Route::post('/session/{session}/testcase/{testcase}/create',[ResponseController::class,'store'])->middleware('auth');

// Update Response
Route::put('/session/{session}/tester/{user}/response/{responses}/testcase/{testCase}',[ResponseController::class,'update'])->middleware('auth');

// Update Response Status
Route::put('/response/{response}',[ResponseController::class,'updateStatus'])->middleware('auth');

// Show Submitted Responses
Route::get('/project/{project}/session/{session}/tester/{user}/responses',[ResponseController::class,'index'])->middleware('auth');



// Show Create User Form
Route::get('/register',[UserController::class,'show'])->middleware('auth');

// Store User Data
Route::post('/users',[UserController::class,'store'])->middleware('auth');

// Show Edit User Form
Route::get('/profile-settings',[UserController::class,'edit'])->middleware('auth');

// Update User Data
Route::put('/users/{user}',[UserController::class,'update'])->middleware('auth');

// Log User Out
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');

//Show Login Form
Route::get('/login', function () {return view('users/login');})->name('login')->middleware('guest');
                                                                                //so when logged in cannot see
/*
Route::get('/', [UserController::class,'login']);
Route::get('/login', [UserController::class,'login']);
*/

//Log In User
Route::post('/users/authenticate',[UserController::class,'authenticate'])->middleware('guest');

//Export to Excel
/*Route::controller(ImportExportController::class)->group(function(){
    Route::post('import', 'import')->name('import');
    Route::get('export', 'export')->name('export');
});*/


// Export to Excel for each tester's responses
Route::get('/session/{session}/tester/{user}/export',[ImportExportController::class,'export'])->name('import')->middleware('auth');

// Export to Excel for every testers in one session
Route::get('/session/{session}/export',[ImportExportController::class,'exportAll'])->name('import')->middleware('auth');

// Export to Excel for every testers in one session
Route::get('/test',[UserController::class,'show']);


