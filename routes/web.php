<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

// Controllers
use App\Http\Controllers\{
    AddressController,
    AgencyController,
    ApplicantController,
    BankAccountController,
    BranchController,
    ClientController,
    CoverageController,
    CoveragePackageController,
    JobController,
    ModuleController,
    ModuloController,
    PermissionController,
    PolicyController,
    ProfileController,
    ReceiptController,
    RoleController,
    UserController,
    WelcomeController,
    ZipCodeController
};

use App\Models\{
    EntryFormat,
    Module,
    PartialReceipt,
    User
};

// PUBLIC ROUTE
Route::get('/', function () {
    return Inertia::render('Welcome/Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

// AUTHENTICATED ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'users' => User::all(),
            'modulos' => Module::all()
        ]);
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resources
    Route::resource('module', ModuleController::class);
    Route::resource('job', JobController::class);
    Route::resource('permissions', PermissionController::class)->names('permissions');
    Route::resource('perfiles', RoleController::class)->parameters(['perfiles' => 'perfiles']);
    Route::resource('user', UserController::class);
    Route::resource('zipcode', ZipCodeController::class);
    Route::resource('address', AddressController::class);
    Route::resource('applicant', ApplicantController::class)->names('applicant');
});

require __DIR__ . '/auth.php';
