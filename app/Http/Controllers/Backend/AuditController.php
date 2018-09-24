<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditController extends Controller
{

    public function index()
    {
        $audits = \OwenIt\Auditing\Models\Audit::with('user')
            ->orderBy('created_at', 'desc')->get();
        return view('audits', ['audits' => $audits]);
    }

}
