<?php

namespace App\Http\Controllers;

use App\Jobs\BackupDatabase;
use App\Jobs\RestoreDatabase;
use App\Models\Backup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DatabaseController extends Controller
{
    public function index() {
        $backups = Backup::with('user')->latest()->get();
        return view('database.index', compact('backups'));
    }

    public function backup(Request $request) {

        if(!$request->input('filename')) {
            return redirect()->route('database.index')->with('error', 'El nombre del archivo es requerido');
        }

        $backupPath = storage_path('app\\backups\\' . date('Y-m-d_H-i-s') . '_avipla_backup.sql');

        $backup = $request->user()->backups()->create([
            'filename' => $request->input('filename'),
            'note' => $request->input('note'),
            'path' => $backupPath,
            'status' => 0,
        ]);

        BackupDatabase::dispatch($backup);

        return redirect()->route('database.index')->with('success', 'Se está generando el backup');
    }

    public function downloadBackup(Backup $backup)
    {
        $backupPath = $backup->path;

        if (file_exists($backupPath)) {
            return response()->download($backupPath, basename($backup->path));
        }

        abort(404, 'Archivo de backup no encontrado.');
    }

    public function restore(Backup $backup) {
        RestoreDatabase::dispatch($backup);
        return redirect()->route('database.index')->with('success', 'Se está restaurando la base de datos');
    }

    public function destroy(Backup $backup) {
        $storageFilePath = explode('app', $backup->path)[1];
        if(file_exists($backup->path)) {
            Storage::delete($storageFilePath);
        }
        $backup->delete();
        return redirect()->route('database.index')->with('success', 'Se eliminó el backup correctamente');
    }
}
