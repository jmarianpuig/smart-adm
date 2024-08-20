<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\MigrateUserController;
use App\Http\Controllers\XtraController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RemovedController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SelectMunicipiosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewerController;
use App\Http\Controllers\YoungerActorController;
use App\Http\Controllers\YoungerXtraController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);
Route::post('/municipios', [SelectMunicipiosController::class, 'index'])->name('getMunicipios');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // Rutas para el controlador ExcelController
    Route::prefix('exports')->group(function () {
        Route::get('/exports/excel/{data}', [ExcelController::class, 'excelViewers'])->name('eventsViewers.excel');
        Route::get('/exports/excel/{modelType}/{info}', [ExcelController::class, 'exportExcel'])->name('exports.excel');
        Route::get('/exports/excel/youngers/{modelType}/{info}', [ExcelController::class, 'exportExcelYounger'])->name('exportsYounger.excel');
        Route::get('/exports/excel/coordinators/{modelType}/{info}', [ExcelController::class, 'exportExcelCoordinator'])->name('exportsCoordinator.excel');
        Route::get('/exports/pdf/{modelType}/{info}', [ExcelController::class, 'exportPdf'])->name('exports.pdf');
        Route::get('/exports/pdf/youngers/{modelType}/{info}', [ExcelController::class, 'exportPdfYounger'])->name('exportsYounger.pdf');
        Route::get('/exports/pdf/coordinators/{modelType}/{info}', [ExcelController::class, 'exportPdfCoordinator'])->name('exportsCoordinator.pdf');
    });

    // Rutas para el controlador ActorController
    Route::prefix('actors')->group(function () {
        Route::get('/', [ActorController::class, 'index'])->name('actors.index');
        Route::get('/create', [ActorController::class, 'create'])->name('actors.create');
        Route::get('/{data:slug}', [ActorController::class, 'show'])->name('actors.show');
        Route::get('/{data:slug}/edit', [ActorController::class, 'edit'])->name('actors.edit');

        Route::post('/', [ActorController::class, 'store'])->name('actors.store');
        Route::patch('/update/{data}', [ActorController::class, 'update'])->name('actors.update');
        Route::patch('/remove/{data}', [ActorController::class, 'removeActorFromList'])->name('actors.remove');
        Route::patch('/restore/{data}', [ActorController::class, 'restoreActorToList'])->name('actors.restore');
        // Route::delete('/delete/{data:slug}', [ActorController::class, 'destroy'])->name('actors.destroy');
    });

    // Rutas para el controlador XtraController
    Route::prefix('extras')->group(function () {
        Route::get('/', [XtraController::class, 'index'])->name('extras.index');
        Route::get('/create', [XtraController::class, 'create'])->name('extras.create');
        Route::get('/{data:slug}', [XtraController::class, 'show'])->name('extras.show');
        Route::get('/{data:slug}/edit', [XtraController::class, 'edit'])->name('extras.edit');

        Route::post('/', [XtraController::class, 'store'])->name('extras.store');
        Route::patch('/update/{data}', [XtraController::class, 'update'])->name('extras.update');
        Route::patch('/remove/{data}', [XtraController::class, 'removeXtraFromList'])->name('extras.remove');
        Route::patch('/restore/{data}', [XtraController::class, 'restoreXtraToList'])->name('extras.restore');
        // Route::delete('/delete/{data:slug}', [XtraController::class, 'destroy'])->name('extras.destroy');
    });

    // Rutas para el controlador YoungerActorController
    Route::prefix('youngers/actors')->group(function () {
        Route::get('/', [YoungerActorController::class, 'index'])->name('youngers.actors.index');
        Route::get('/create', [YoungerActorController::class, 'create'])->name('youngers.actors.create');
        Route::get('/{data:slug}', [YoungerActorController::class, 'show'])->name('youngers.actors.show');
        Route::get('/{data:slug}/edit', [YoungerActorController::class, 'edit'])->name('youngers.actors.edit');
    
        Route::post('/', [YoungerActorController::class, 'store'])->name('youngers.actors.store');
        Route::patch('/update/{data}', [YoungerActorController::class, 'update'])->name('youngers.actors.update');
        Route::patch('/remove/{data}', [YoungerActorController::class, 'removeYoungerActorFromList'])->name('youngers.actors.remove');
        Route::patch('/restore/{data}', [YoungerActorController::class, 'restoreYoungerActorToList'])->name('youngers.actors.restore');
        // Route::delete('/delete/{data:slug}', [YoungerActorController::class, 'delete'])->name('youngers.actors.destroy');
    });

    // Rutas para el controlador YoungerXtraController
    Route::prefix('youngers/extras')->group(function () {
        Route::get('/', [YoungerXtraController::class, 'index'])->name('youngers.extras.index');
        Route::get('/create', [YoungerXtraController::class, 'create'])->name('youngers.extras.create');
        Route::get('/{data:slug}', [YoungerXtraController::class, 'show'])->name('youngers.extras.show');
        Route::get('/{data:slug}/edit', [YoungerXtraController::class, 'edit'])->name('youngers.extras.edit');
        Route::patch('/remove/{data}', [YoungerXtraController::class, 'removeYoungerExtraFromList'])->name('youngers.extras.remove');
        Route::patch('/restore/{data}', [YoungerXtraController::class, 'restoreYoungerExtraToList'])->name('youngers.extras.restore');
    
        Route::post('/', [YoungerXtraController::class, 'store'])->name('youngers.extras.store');
        Route::patch('/update/{data}', [YoungerXtraController::class, 'update'])->name('youngers.extras.update');
        // Route::delete('/delete/{data:slug}', [YoungerXtraController::class, 'delete'])->name('youngers.extras.destroy');
    });

    
    // Rutas para el controlador CoordinatorController
    Route::prefix('coordinators')->group(function () {
        Route::get('/', [CoordinatorController::class, 'index'])->name('coordinators.index');
        Route::get('/create', [CoordinatorController::class, 'create'])->name('coordinators.create');
        Route::get('/{data:slug}', [CoordinatorController::class, 'show'])->name('coordinators.show');
        Route::get('/{data:slug}/edit', [CoordinatorController::class, 'edit'])->name('coordinators.edit');

        Route::post('/', [CoordinatorController::class, 'store'])->name('coordinators.store');
        Route::patch('/update/{data}', [CoordinatorController::class, 'update'])->name('coordinators.update');
        Route::patch('/remove/{data}', [CoordinatorController::class, 'removeCoordinatorFromList'])->name('coordinators.remove');
        Route::patch('/restore/{data}', [CoordinatorController::class, 'restoreCoordinatorToList'])->name('coordinators.restore');
        // Route::delete('/delete/{data:slug}', [XtraController::class, 'destroy'])->name('extras.destroy');
    });

    // Rutas para el controlador EventController
    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('events.index');
        Route::get('/create', [EventController::class, 'create'])->name('events.create');
        Route::get('/show/{data}', [EventController::class, 'show'])->name('events.show');
        Route::get('/edit/{data}', [EventController::class, 'edit'])->name('events.edit');
    
        Route::post('/', [EventController::class, 'store'])->name('events.store');
        Route::patch('/update', [EventController::class, 'update'])->name('events.update');
        Route::patch('/remove/{data}', [EventController::class, 'removeEventFromList'])->name('events.remove');
        Route::patch('/restore/{data}', [EventController::class, 'restoreEventToList'])->name('events.restore');
        Route::delete('/delete/{data}', [EventController::class, 'destroy'])->name('events.destroy');
    
    });

    // Rutas para el controlador ViewerController
    Route::prefix('viewers')->group(function () {
        Route::patch('/', [ViewerController::class, 'update'])->name('viewers.update');
    });

    // rutas para migraciones entre tablas actores y extras
    Route::prefix('migrate')->group(function () {
        Route::get('/toActor/{data}', [MigrateUserController::class, 'extraToActor'])->name('migrate.extraToActor');
        Route::get('/toExtra/{data}', [MigrateUserController::class, 'actorToExtra'])->name('migrate.actorToExtra');
    });

    // rutas para usuarios
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::patch('/update/{user}', [UserController::class, 'update'])->name('users.update');
        Route::patch('/remove/{user}', [UserController::class, 'removeUserFromList'])->name('users.remove');
        Route::patch('/restore/{user}', [UserController::class, 'restoreUserToList'])->name('users.restore');
        // Route::delete('/delete/{data:slug}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // rutas para roles
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::get('/{role}', [RoleController::class, 'show'])->name('roles.show');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');

        Route::post('/', [RoleController::class, 'store'])->name('roles.store');
        Route::patch('/update/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/delete/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });
});

Route::middleware('auth')->group(function () {
});


require __DIR__ . '/auth.php';
