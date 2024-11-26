<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DatabaseController extends Controller
{
    public function index() {
        return view('database.index');
    }

    public function backup() {
        // Configuración
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');
        $backupPath = storage_path('app\\backups\\' . date('Y-m-d_H-i-s') . '_backup.sql');
        $mysqldumpPath = 'C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysqldump.exe';

        // Comando mysqldump
        $command = sprintf(
            '"%s" -u %s -p"%s" %s > "%s"',
            $mysqldumpPath,
            $dbUser,
            $dbPass,
            $dbName,
            $backupPath
        );

        // Ejecutar el comando
        $process = Process::fromShellCommandline($command);
        $process->setTimeout(500);
        $process->run();

        // Verificar errores
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->download($backupPath)->deleteFileAfterSend(true);
    }
}
