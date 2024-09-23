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

Route::get('/',[HomeController::class,'home'])->name("home")->middleware(['auth', 'checkMaxSessions']);
Route::resource('region', RegionController::class)->middleware(['auth', 'admin']);
Route::resource('departement', DepartementController::class)->middleware(['auth', 'admin']);
Route::resource('liste', ListeController::class)->middleware(['auth', 'admin']);
Route::resource('listenational', ListeNationalController::class)->middleware(['auth', 'checkMaxSessions']);
Route::resource('listedepartemental', ListeDepartementalController::class)->middleware( ['auth', 'checkMaxSessions']);
Route::resource('user', UserController::class)->middleware(['auth', 'admin']);
Route::get('/modifier/motdepasse',[UserController::class,'modifierMotDePasse'])->name("modifier.motdepasse")->middleware(['auth', 'checkMaxSessions']);


Route::post('/importer/region',[RegionController::class,'importExcel'])->name("importer.region")->middleware(['auth', 'admin']);

Route::post('/importer/departement',[DepartementController::class,'importExcel'])->name("importer.departement")->middleware(['auth', 'admin']);


Route::post('/importer/listeNational',[ListeNationalController::class,'importExcel'])->name("importer.listenational")->middleware(['auth', 'checkMaxSessions']);

Route::post('/importer/listedepartemental',[ListeDepartementalController::class,'importExcel'])->name("importer.listedepartemental")->middleware(['auth', 'checkMaxSessions']);

Route::post('/search/listenational',[ListeNationalController::class,'search'])->name("search.listenational")->middleware(['auth', 'checkMaxSessions']);

Route::post('/search/listedepartemental',[ListeDepartementalController::class,'search'])->name("search.listedepartemental")->middleware(['auth', 'checkMaxSessions']);

Route::get('/listedepartemental/changer/etat/{id}',[ListeDepartementalController::class,'changerEtat'])->name("changer.etat.listedepartemental")->middleware(["auth",'admin']);

Route::get('/listenationnal/changer/etat/{id}',[ListeNationalController::class,'changerEtat'])->name("changer.etat.listenational")->middleware(["auth",'admin']);

Route::get('/tab/{type}',[HomeController::class,'liste'])->name("liste.tableau")->middleware(["auth"]);

Route::get('/liste/admin/{id}',[HomeController::class,'listeAdmin'])->name("liste.admin")->middleware(["auth"]);
Route::get('/last/save/by/liste/{scrutin}/{type}/{departement_id}',[ListeDepartementalController::class,'getLasTCandidatByListe'])->name("last.save.by.liste");

Route::post('/search/ajax',[ListeDepartementalController::class,'searchAjax'])->name("search.ajax")->middleware(["auth"]);

Route::post('/update/password',[UserController::class,'updatePassword'])->name("user.password.update")->middleware(["auth","checkMaxSessions"]);

Route::post('/search/candidat',[HomeController::class,'searchCandidat'])->name("search.candidat")->middleware(["auth","admin"]);

Route::post('/formulaire',[HomeController::class,'formulaire'])->name("generer.formulaire")->middleware(['auth', 'checkMaxSessions']);


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

Route::get('/recherche/candidat', [ListeDepartementalController::class,'listeCandidat'])->name("liste.candidat")->middleware(['auth', 'checkMaxSessions']);

Route::get('/state/by/{scrutin}/{liste}', [HomeController::class,'stateByScrutin'])->name("state.by.scrutin")->middleware(['auth', 'checkMaxSessions']);

Route::get('/supprimer/liste/{scrutin}/{type}/{departement}', [HomeController::class,'supprimerListe'])->name("supprimer.liste")->middleware(['auth', 'checkMaxSessions']);

Route::get('/supprimer/liste', [HomeController::class,'supprimerVoir'])->name("supprimer.voir")->middleware(['auth', 'checkMaxSessions']);

Route::get('/recap', [HomeController::class,'recap'])->name("recap")->middleware(['auth', 'checkMaxSessions']);

require __DIR__.'/auth.php';