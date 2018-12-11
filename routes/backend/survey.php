<?php
//Route::get('cadmin/upper/{level}','CountryController@getUpperLevelData');
/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'prefix'     => 'survey',
    'as'         => 'survey.',
    'namespace'  => 'Survey',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {

    /**
     *Form Administration management
     */
    Route::group(['namespace' => 'Form'], function() {
        Route::resource('form', 'FormController');

    });



});
