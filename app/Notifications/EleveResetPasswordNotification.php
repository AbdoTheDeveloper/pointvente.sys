<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EleveResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Réinitialisation du mot de passe '.config('app.name'))
                    ->from('louis.massignon@alkhadim.ma', config('app.name'))
                    ->line('Nous avons reçu une demande de réinitialisation du mot de passe.')
                    ->action('Réinitialiser', route('eleve.password.reset', $this->token))
                    ->line("Les informations contenues dans cette communication sont uniquement destinées à l'usage de la personne physique ou morale à laquelle elles sont adressées et des personnes autorisées à les recevoir. Il peut contenir des informations confidentielles ou légalement protégées. Si vous n'êtes pas le destinataire prévu, vous êtes informé que toute divulgation, copie, distribution ou action fondée sur le contenu de ces informations est strictement interdite et peut être illégale. Si vous avez reçu cette communication par erreur, veuillez nous en informer immédiatement en répondant à cet e-mail, puis supprimez-le de votre système. ".config('app.name')." n'est pas responsable de la transmission correcte et complète des informations contenues dans cette communication, ni de tout retard dans sa réception.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
