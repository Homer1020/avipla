<?php

namespace App\Notifications;

use App\Models\AvisoCobro;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AvisoCobroStatusChanged extends Notification
{
    use Queueable;

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
                ->subject('Cambió el estado del recibo #'  . $this->avisoCobro->codigo_aviso)
                ->greeting('¡Hola!')
                ->line('Te informamos que cambió el estado del recibo #'  . $this->avisoCobro->codigo_aviso . ' a "' . $this->avisoCobro->estado . '"')
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
        $bg_class = match($this->avisoCobro->estado) {
            'PENDIENTE'     => 'bg-secondary',
            'REVISION'      => 'bg-warning',
            'CONCILIADO'    => 'bg-success',
            'DEVUELTO'     => 'bg-danger'
        };
        return [
            'icon'              => 'fa fa-file-invoice',
            'bg-class'          => $bg_class,
            'invoice_id'        => $this->avisoCobro->id,
            'codigo_aviso'      => $this->avisoCobro->codigo_aviso,
            'status'            => $this->avisoCobro->estado,
            'url'               => route('avisos-cobro.show', $this->avisoCobro->id),
            'message'           => 'Hola ' . $notifiable->name . '! Cambió el estado del recibo #'  . $this->avisoCobro->codigo_aviso . ' a "' . $this->avisoCobro->estado . '"'
        ];
    }
}
