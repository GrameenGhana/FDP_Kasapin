<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('cadmin/upper/{level}/{country}','Auth\Country\CountryController@getUpperLevelData');

Route::get('audits', 'AuditController@index')->name('audits');
Route::get('forms', 'FormController@index')->name('forms');