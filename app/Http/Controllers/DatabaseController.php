<?php

namespace App\Http\Controllers;

use App\Jobs\BackupDatabase;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DatabaseController extends Controller
{
    public function index() {
        return view('database.index');
    }

    public function backup() {

        BackupDatabase::dispatch();

        return redirect()->route('database.index')->with('success', 'Se está generando el backup');
    }
}
