<?php
/**
 * BreadCrumb Settings for Country .
 * User: spomega
 * Date: 10/10/18
 * Time: 10:14 AM
 */


Breadcrumbs::for('admin.auth.country.index', function($trail){
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.access.countries.management'), route('admin.auth.country.index'));
});

Breadcrumbs::for('admin.auth.country.create', function($trail){
    $trail->parent('admin.auth.country.index');
    $trail->push(__('menus.backend.access.countries.create'), route('admin.auth.country.create'));
});

Breadcrumbs::for('admin.auth.country.edit', function ($trail, $id) {
    $trail->parent('admin.auth.permission.index');
    $trail->push(__('menus.backend.access.countries.edit'), route('admin.auth.country.edit', $id));
});

Breadcrumbs::for('admin.auth.country.admin.add', function ($trail, $id) {
    $trail->parent('admin.auth.country.index');
    $trail->push(__('menus.backend.access.countries.edit'), route('admin.auth.country.admin.add', $id));
});


