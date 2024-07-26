<?php

namespace App\Console\Commands;

use App\Models\Afiliado;
use App\Notifications\PaymentReminder;
use Illuminate\Console\Command;

class PaymentsPendingNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:payments-pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifica por correo a los usuario para que panguen sus recibos.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $afiliados = Afiliado::whereDoesntHave('avisosCobros', function($query) {
            $query->whereIn('estado', ['CONCILIADO', 'REVISION']);
        })->get();

        foreach ($afiliados as $afiliado) {
            foreach ($afiliado->avisosCobros as $avisoCobro) {
                if($afiliado->presidente) {
                    $afiliado->presidente->notify(new PaymentReminder($avisoCobro));
                }
                if($afiliado->director) {
                    $afiliado->director->notify(new PaymentReminder($avisoCobro));
                }
                $afiliado->user->notify(new PaymentReminder($avisoCobro));
            }
        }
    }
}
