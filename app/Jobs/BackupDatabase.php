<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class BackupDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
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

            Log::info("Backup completado exitosamente");
        } catch(\Exception $e) {
            $this->fail($e);
        }
    }
}
