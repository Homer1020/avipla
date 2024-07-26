<?php

namespace App\Notifications;

use App\Models\AvisoCobro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentReminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public AvisoCobro $avisoCobro
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Recordatorio de Aviso de Cobro')
                    ->line('Este es un recordatorio para el aviso de cobro con código: ' . $this->avisoCobro->codigo_aviso)
                    ->line('El monto pendiente es de: $' . $this->avisoCobro->monto_total)
                    ->line('Por favor, realice el pago a la brevedad.')
                    ->action('Ver Aviso de Cobro', url('/pagos/' . $this->avisoCobro->id . '/detalle'))
                    ->line('Gracias por su atención.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
