<?php

namespace App\Notifications;

use App\Models\Boletine;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class BoletinCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Boletine $boletine)
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
                ->subject('Se creó un nuevo boletín "'. $this->boletine->titulo .'"')
                ->greeting('¡Hola!')
                ->line('Te informamos que creó un nuevo boletín "'. $this->boletine->titulo .'"')
                ->line('A continuación, puedes revisar los detalles:')
                ->line(new HtmlString('<div style="border: 1px solid #ccc; padding: 16px; margin-bottom: 16px; border-radius: 10px;">' . $this->boletine->contenido . '</div>'))
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
            'icon'              => 'fa fa-envelope',
            'bg-class'          => 'bg-warning',
            'url'               => route('boletines.show', $this->boletine),
            'boletine_id'       => $this->boletine->id,
            'boletine_slug'     => $this->boletine->slug,
            'titulo'            => $this->boletine->titulo,
            'message'           => 'Se creó un nuevo boletin "'. $this->boletine->titulo .'"'
        ];
    }
}
