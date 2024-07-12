<?php

namespace App\Notifications;

use App\Models\AvisoCobro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PayUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public AvisoCobro $avisoCobro
    )
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
            ->subject('Actualización de datos de pago para la factura #' . $this->avisoCobro->codigo_aviso)
            ->greeting('¡Hola!')
            ->line('Te informamos que se han actualizado los datos del pago para la factura #' . $this->avisoCobro->codigo_aviso . '.')
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
            'bg-class'          => 'bg-danger',
            'invoice_id'        => $this->avisoCobro->id,
            'codigo_aviso'      => $this->avisoCobro->codigo_aviso,
            'message'           => 'Se actualizaron los datos del pago para la factura #'  . $this->avisoCobro->codigo_aviso
        ];
    }
}
