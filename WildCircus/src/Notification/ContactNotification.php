<?php

namespace App\Notification;

use App\Entity\Contact;
use App\Entity\Reservation;
use Twig\Environment;

class ContactNotification
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer )
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact)
    {
        $message = (new \Swift_Message('Votre email a bien été envoyé!'))
            ->setFrom('max.vasseur.79@gmail.com')
            ->setTo('max.vasseur.79@gmail.com')
            ->setBody($this->renderer->render('/email/notification.html.twig', ['contact' => $contact ]

            ), 'text/html');

        $this->mailer->send($message);

    }
    public function reservationNotify(Reservation $reservation)
    {
        $message = (new \Swift_Message('Votre email a bien été envoyé!'))
            ->setFrom('max.vasseur.79@gmail.com')
            ->setTo($reservation->getmail())
            ->setBody($this->renderer->render('/email/reservation.html.twig', ['reservation' => $reservation ]

            ), 'text/html');

        $this->mailer->send($message);

    }
}