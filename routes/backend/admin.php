<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', 'DashboardController@index')->name('dashboard');

Route::get('audits', 'AuditController@index')
    ->middleware('auth', \App\Http\Middleware\AllowOnlyAdmin::class);
