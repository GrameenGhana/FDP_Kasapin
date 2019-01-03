<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class AuditController extends Controller
{

    public function index()
    {

        $audits = \OwenIt\Auditing\Models\Audit::with('user')
            ->orderBy('created_at', 'desc')->get();
        return view('backend.audits', ['audits' => $audits]);
    }

}
