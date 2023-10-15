<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProjectController as GuestProjectController;
use App\Http\Controllers\ProfileController;
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
  return view('welcome');
});

Route::get('/dashboard', function () {
  return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');


// Routes group for ADMIN
// admin.projects.index, admin.projects.show, admin.projects.create, admin.projects.edit, admin.project.update & admin.projects.delete
Route::middleware(["auth", "verified"])
  ->prefix("admin")
  ->name("admin.")
  ->group(function () {
  Route::resource("projects", ProjectController::class);
  /* Route::get("/projects/{project}", [ProjectController::class, "show"])->name("projects.show"); */
});

// Routes for GUESTS
// projects.index
Route::get("/projects", [GuestProjectController::class, "index"])->name("projects.index");

Route::middleware('auth')->group(function () {
  Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
  Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
  Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__ . '/auth.php';
