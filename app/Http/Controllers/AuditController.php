<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $audits = Audit::latest()->get();
        return view('audits.index', compact('audits'));
    }

    public function show(Audit $audit) {
        dump($audit->toArray());
    }
}
