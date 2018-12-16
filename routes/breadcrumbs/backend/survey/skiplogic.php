<?php
/**
 * BreadCrumb Settings for SkipLogic .
 * User: liman
 */


Breadcrumbs::for('admin.survey.skiplogic.index', function($trail){
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.survey.skiplogics.management'), route('admin.survey.skiplogic.index'));
});

Breadcrumbs::for('admin.survey.skiplogic.create', function($trail){
    $trail->parent('admin.survey.form.index');
    $trail->push(__('menus.backend.survey.skiplogics.create'), route('admin.survey.skiplogic.create'));
});

Breadcrumbs::for('admin.survey.skiplogic.edit', function ($trail, $id) {
    $trail->parent('admin.survey.form.index');
    $trail->push(__('menus.backend.survey.skiplogics.edit'), route('admin.survey.skiplogic.edit', $id));
});



