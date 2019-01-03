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
        Route::get('question/tables', 'FormController@getTables')->name('form.question.tables');
        Route::get('question/columns/{table}', 'FormController@getTableColumns')->name('form.question.columns');
        Route::get('question/add/{form}', 'FormController@createQuestion')->name('form.question.add');
        Route::get('question/all/{form}', 'FormController@allQuestions')->name('form.question.all');
        Route::post('question/create', 'FormController@storeQuestion')->name('form.question.create');
        Route::get('question/edit/{question}', 'FormController@editQuestion')->name('form.question.edit');
        Route::post('question/destroy/{question}', 'FormController@destroyQuestion')->name('form.question.destroy');
        Route::patch('question/update/{question}', 'FormController@updateQuestion')->name('form.question.update');

    });

    /**
     *SkipLogic Administration management
     */
    Route::group(['namespace' => 'SkipLogic'], function() {
        Route::resource('skiplogic', 'SkipLogicController');

    });



});
