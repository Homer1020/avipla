<?php

namespace App\Jobs;

use App\Models\Backup;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class RestoreDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Backup $backup
    )
    {}

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
            $mysqldumpPath = 'C:\\laragon\\bin\mysql\\mysql-8.0.30-winx64\\bin\\mysql.exe';

            // Comando mysqldump
            $command = sprintf(
                '"%s" -u %s -p"%s" %s < "%s"',
                $mysqldumpPath,
                $dbUser,
                $dbPass,
                $dbName,
                $this->backup->path
            );

            // Ejecutar el comando
            $process = Process::fromShellCommandline($command);
            $process->setTimeout(500);
            $process->run();

            // Verificar errores
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            Log::info($command);
            Log::info("Backup restaurado exitosamente");
        } catch(Exception $e) {
            Log::info($e->getLine());
            Log::info($e->getMessage());
            Log::info(['ok' => false]);
            $this->fail($e);
        }
    }
}
