<?php

namespace App\Notifications;

use App\Models\AvisoCobro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AvisoCobroPaid extends Notification
{
    use Queueable;

    # llega al director

    /**
     * Create a new notification instance.
     */
    public function __construct(public AvisoCobro $avisoCobro)
    {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Se realizó pago para el aviso de cobro #' . $this->avisoCobro->codigo_aviso)
            ->greeting('¡Hola!')
            ->line('Te informamos que se adjunto un pago para el resivo #' . $this->avisoCobro->codigo_aviso . '.')
            ->line('A continuación, puedes revisar los detalles:')
            ->line('Fecha de actualización: ' . now())
            ->action('Entrar a AVIPLA', url('/dashboard'))
            ->line('¡Gracias por tu atención!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'icon'              => 'fa fa-file-invoice',
            'bg-class'          => 'bg-secondary',
            'aviso_id'          => $this->avisoCobro->id,
            'codigo_aviso'      => $this->avisoCobro->codigo_aviso,
            'url'               => route('avisos-cobro.show', $this->avisoCobro->id),
            'message'           => 'Se realizó pago para el aviso de cobro #' . $this->avisoCobro->codigo_aviso
        ];
    }
}
