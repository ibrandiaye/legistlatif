<?php

use App\Http\Controllers\DepartementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListeController;
use App\Http\Controllers\ListeDepartementalController;
use App\Http\Controllers\ListeNationalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
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

Route::get('/',[HomeController::class,'home'])->name("home")->middleware("auth");
Route::resource('region', RegionController::class)->middleware("auth");
Route::resource('departement', DepartementController::class)->middleware("auth");
Route::resource('liste', ListeController::class)->middleware("auth");
Route::resource('listenational', ListeNationalController::class)->middleware("auth");
Route::resource('listedepartemental', ListeDepartementalController::class)->middleware("auth");
Route::resource('user', UserController::class)->middleware("auth");


Route::post('/importer/region',[RegionController::class,'importExcel'])->name("importer.region")->middleware("auth");

Route::post('/importer/departement',[DepartementController::class,'importExcel'])->name("importer.departement")->middleware("auth");


Route::post('/importer/listeNational',[ListeNationalController::class,'importExcel'])->name("importer.listenational")->middleware("auth");

Route::post('/importer/listedepartemental',[ListeDepartementalController::class,'importExcel'])->name("importer.listedepartemental")->middleware("auth");

Route::post('/search/listenational',[ListeNationalController::class,'search'])->name("search.listenational")->middleware("auth");

Route::post('/search/listedepartemental',[ListeDepartementalController::class,'search'])->name("search.listedepartemental")->middleware("auth");

Route::get('/listedepartemental/changer/etat/{id}',[ListeDepartementalController::class,'changerEtat'])->name("changer.etat.listedepartemental")->middleware(["auth",'admin']);

Route::get('/listenationnal/changer/etat/{id}',[ListeNationalController::class,'changerEtat'])->name("changer.etat.listenational")->middleware(["auth",'admin']);

Route::get('/tab/{type}',[HomeController::class,'liste'])->name("liste.tableau")->middleware(["auth"]);

Route::get('/liste/admin/{id}',[HomeController::class,'listeAdmin'])->name("liste.admin")->middleware(["auth"]);
Route::get('/last/save/by/liste/{scrutin}/{type}/{departement_id}',[ListeDepartementalController::class,'getLasTCandidatByListe'])->name("last.save.by.liste");

Route::post('/search/ajax',[ListeDepartementalController::class,'searchAjax'])->name("search.ajax")->middleware(["auth"]);

Route::post('/update/password',[UserController::class,'updatePassword'])->name("user.password.update")->middleware(["auth","admin"]);

Route::post('/search/candidat',[HomeController::class,'searchCandidat'])->name("search.candidat")->middleware(["auth","admin"]);

Route::post('/formulaire',[HomeController::class,'formulaire'])->name("generer.formulaire")->middleware("auth");


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/get/by/departement/{id}',[DepartementController::class,'getByIdDepartement'])->name("get.departement.id");

Route::get('/declaration/{id}/{type}', [HomeController::class,'declarer'])->name("declaration");

Route::get('/recherche/candidat', [ListeDepartementalController::class,'listeCandidat'])->name("liste.candidat")->middleware("auth");

Route::get('/state/by/{scrutin}', [HomeController::class,'stateByScrutin'])->name("state.by.scrutin")->middleware("auth");

Route::get('/supprimer/liste/{scrutin}/{type}/{departement}', [HomeController::class,'supprimerListe'])->name("supprimer.liste")->middleware("auth");

Route::get('/supprimer/liste', [HomeController::class,'supprimerVoir'])->name("supprimer.voir")->middleware("auth");

require __DIR__.'/auth.php';