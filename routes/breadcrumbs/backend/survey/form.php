<?php
/**
 * BreadCrumb Settings for Form .
 * User: liman
 */


Breadcrumbs::for('admin.survey.form.index', function($trail){
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.survey.forms.management'), route('admin.survey.form.index'));
});

Breadcrumbs::for('admin.survey.form.create', function($trail){
    $trail->parent('admin.survey.form.index');
    $trail->push(__('menus.backend.survey.forms.create'), route('admin.survey.form.create'));
});

Breadcrumbs::for('admin.survey.form.edit', function ($trail, $id) {
    $trail->parent('admin.survey.form.index');
    $trail->push(__('menus.backend.survey.forms.edit'), route('admin.survey.form.edit', $id));
});

Breadcrumbs::for('admin.survey.form.question.add', function ($trail, $id) {
    $trail->parent('admin.survey.form.index');
    $trail->push(__('menus.backend.survey.forms.questions.create'), route('admin.survey.form.question.add', $id));
});

Breadcrumbs::for('admin.survey.form.question.all', function ($trail, $id) {
    $trail->parent('admin.survey.form.index');
    $trail->push(__('menus.backend.survey.forms.questions.all'), route('admin.survey.form.question.all', $id));
});

Breadcrumbs::for('admin.survey.form.question.edit', function ($trail, $id) {
    $trail->parent('admin.survey.form.question.index');
    $trail->push(__('menus.backend.survey.forms.questions.edit'), route('admin.survey.form.question.edit', $id));
});

Breadcrumbs::for('admin.survey.form.question.update', function ($trail, $id) {
    $trail->parent('admin.survey.form.question.index');
    $trail->push(__('menus.backend.survey.forms.questions.update'), route('admin.survey.form.question.update', $id));
});




