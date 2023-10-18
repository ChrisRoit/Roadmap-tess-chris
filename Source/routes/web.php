<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KerntaakResourceController as KerntaakResourceController;
use App\http\Controllers\WorkProcessesResourceController as WorkProcessesResourceController;
use App\Http\Controllers\TicketsResourceController as TicketsResourceController;
use App\Http\Controllers\UsersResourceController as UsersResourceController;
use App\Http\Controllers\UsersController as UsersController;
use App\Http\Controllers\OpleidingsResourceController as OpleidingsResourceController;
use App\Http\Controllers\RoadmapsResourceController as RoadmapsResourceController;

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

Route::group(["prefix" => "tickets", "middleware" => "auth:web"],function(){
    //Route::get("/",[TicketsResourceController::class,"overview"])->name("overview");
    Route::get('/', [TicketsResourceController::class, 'index'])->name("ticket");
    Route::get('/create', [TicketsResourceController::class, 'create'])->name("ticket_create");
    Route::post('/store', [TicketsResourceController::class, 'store'])->name("ticket_store");
    Route::get('/show/{id}', [TicketsResourceController::class, 'show'])->name("ticket_show");
    Route::get('/{id}/edit', [TicketsResourceController::class, 'edit'])->name("ticket_edit");
    Route::post('/update', [TicketsResourceController::class, 'update'])->name("update-ticket");
    Route::get('/{id}/destroy', [TicketsResourceController::class, 'destroy'])->name("ticket_delete");
});

Route::prefix("users")->group(function(){
    Route::get("/",[UsersResourceController::class,"index"])->name("users");
    Route::post("/store",[UsersResourceController::class,"store"])->name("users_store");
    Route::post("/update",[UsersResourceController::class,"update"])->name("users_update");
    Route::post("/delete",[UsersResourceController::class,"destroy"])->name("users_delete");
    Route::get("/usersdata",[UsersController::class,"getUsersData"])->name("users_data");
});

Route::group(["prefix" => "degrees","middleware" => "auth:web"],function(){
    Route::get("/",[OpleidingsResourceController::class,"index"])->name("degrees");
    Route::get("/create",[OpleidingsResourceController::class,"create"])->name("degrees_create");
    Route::post("/store",[OpleidingsResourceController::class,"store"])->name("degrees_store");
    Route::get('/{id}', [OpleidingsResourceController::class, 'show'])->name("degrees_show");
    Route::get('/{id}/edit', [OpleidingsResourceController::class, 'edit'])->name("degrees_edit");
    Route::post('/update', [OpleidingsResourceController::class, 'update'])->name("degrees_update");
    Route::get('/{id}/destroy', [OpleidingsResourceController::class, 'destroy'])->name("degrees_delete");
});

Route::group(["prefix" => "workprocesses","middleware" => "auth:web"],function(){
    Route::get('/', [WorkProcessesResourceController::class, 'index'])->name("workprocesses");
    Route::get('/create', [WorkProcessesResourceController::class, 'create'])->name("workprocesses_create");
    Route::post('/store', [WorkProcessesResourceController::class, 'store'])->name("workprocesses_store");
    Route::get('/{id}', [WorkProcessesResourceController::class, 'show'])->name("workprocesses_show");
    Route::get('/{id}/edit', [WorkProcessesResourceController::class, 'edit'])->name("workprocesses_edit");
    Route::post('/update', [WorkProcessesResourceController::class, 'update'])->name("workprocesses_update");
    Route::get('/{id}/destroy', [WorkProcessesResourceController::class, 'destroy'])->name("workprocesses_delete");
});

Route::get('/register', function () {return redirect('/');});
Route::post('/register', function () {return redirect('/');});

Route::group(["prefix" => "kerntaken", "middleware" => "auth:web"],function(){
    Route::get('/', [KerntaakResourceController::class, 'index'])->name("kerntaken");
    Route::get('/create', [KerntaakResourceController::class, 'create'])->name("kerntaken_create");
    Route::post('/store', [KerntaakResourceController::class, 'store'])->name("kerntaken_store");
    Route::get('/{id}', [KerntaakResourceController::class, 'show'])->name("kerntaken_show");
    Route::get('/{id}/edit', [KerntaakResourceController::class, 'edit'])->name("kerntaken_edit");
    Route::post('/update', [KerntaakResourceController::class, 'update'])->name("update-kerntaak");
    Route::get('/{id}/destroy', [KerntaakResourceController::class, 'destroy'])->name("kerntaken_delete");
});

Route::group(["prefix" => "roadmaps","middleware" => "auth:web"],function(){
    Route::get("/",[RoadmapsResourceController::class,"index"])->name("roadmaps");
    Route::get("/create",[RoadmapsResourceController::class,"create"])->name("roadmaps_create");
    Route::post("/store",[RoadmapsResourceController::class,"store"])->name("roadmaps_store");
    Route::post("/update",[RoadmapsResourceController::class,"update"])->name("roadmaps_update");
    Route::get("show/{id}",[RoadmapsResourceController::class,"show"])->name("roadmaps_show");
    Route::get("/edit/{id}",[RoadmapsResourceController::class,"edit"])->name("roadmaps_edit");
    Route::get("/destroy/{id}",[RoadmapsResourceController::class,"destroy"])->name("roadmaps_delete");
});