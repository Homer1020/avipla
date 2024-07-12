<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Invoice $invoice)
    {
        $this->invoice->load('avisoCobro');
    }

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
                ->subject('Factura para el recibo #' . $this->invoice->numero_factura)
                ->greeting('¡Hola!')
                ->line('Te informamos que se facturó el recibo #' . $this->invoice->avisoCobro->codigo_aviso . ' con la factura #' . $this->invoice->numero_factura . '.')
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
            'icon'              => 'fas fa-check',
            'bg-class'          => 'bg-success',
            'invoice_id'        => $this->invoice->id,
            'codigo_aviso'      => $this->invoice->avisoCobro->codigo_aviso,
            'message'           => 'Se facturó el recibo #' . $this->invoice->avisoCobro->codigo_aviso . ' con la factura #' . $this->invoice->numero_factura . '.'
        ];
    }
}
