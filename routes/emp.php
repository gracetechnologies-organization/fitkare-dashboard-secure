<?php
use App\Http\Livewire\Admin\ManageEmployees;
use App\Http\Livewire\Employee\Dashboard;
use App\Http\Livewire\Employee\ManageActiveExercises;
use App\Http\Livewire\Employee\ManageArchivedExercises;
use App\Http\Livewire\Employee\ManageCategories;
use App\Http\Livewire\Employee\ManageExercises;
use App\Http\Livewire\Employee\ManageLevels;
use App\Http\Livewire\Employee\ManagePrograms;
use App\Http\Livewire\Employee\Profile;

Route::middleware('emp_guard')->prefix('emp')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('emp.index');
    Route::get('/categories', ManageCategories::class)->name('emp.categories');
    Route::get('/levels', ManageLevels::class)->name('emp.levels');
    Route::get('/programs', ManagePrograms::class)->name('emp.programs');
    Route::get('/exercises/active', ManageActiveExercises::class)->name('emp.exercises.active');
    Route::get('/exercises/archived', ManageArchivedExercises::class)->name('emp.exercises.archived');
    Route::get('/profile', Profile::class)->name('emp.profile');
    Route::post('/update-employee', [EmployeeController::class, 'update_emp'])->name('emp.update');
    Route::post('/update-password', [EmployeeController::class, 'update_emp_password'])->name('emp.update_password');

    Route::get('/employees', ManageEmployees::class)->name('admin.employees');
});