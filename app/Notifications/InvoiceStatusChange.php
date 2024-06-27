<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceStatusChange extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Invoice $invoice
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $bg_class = match($this->invoice->estado) {
            'PENDIENTE'     => 'bg-secondary',
            'REVISION'      => 'bg-warning',
            'COMPLETADO'    => 'bg-success',
            'CANCELADO'     => 'bg-danger'
        };
        return [
            'icon'              => 'fa fa-file-invoice',
            'bg-class'          => $bg_class,
            'invoice_id'        => $this->invoice->id,
            'numero_factura'    => $this->invoice->numero_factura,
            'status'            => $this->invoice->estado,
            'message'           => 'Cambió el estado de la factura #'  . $this->invoice->numero_factura . ' a "' . $this->invoice->estado . '"'
        ];
    }
}
