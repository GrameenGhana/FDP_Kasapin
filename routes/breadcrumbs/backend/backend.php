<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

Breadcrumbs::for('admin.audits', function ($trail) {
        $trail->push(__('strings.backend.dashboard.title'), route('admin.audits'));
});

require __DIR__.'/survey/form.php';
require __DIR__.'/survey/skiplogic.php';
require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
