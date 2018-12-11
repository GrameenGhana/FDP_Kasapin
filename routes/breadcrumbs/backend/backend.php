<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

Breadcrumbs::for('admin.audits', function ($trail) {
        $trail->push(__('strings.backend.dashboard.title'), route('admin.audits'));
});

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

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
