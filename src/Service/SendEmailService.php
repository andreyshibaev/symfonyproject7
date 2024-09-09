<?php

namespace App\Service;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class SendEmailService
{
    public function __construct(
        private MailerInterface $mailer
    ) {
    }

    public function sendEmail(
        $admin_email,
        $subject = 'Message received',
        $bodyLetter = null
    ): void {
        $message = (new Email())
            ->from($admin_email)
            ->to($admin_email)
            ->subject($subject)
            ->html($bodyLetter);
        $transport = Transport::fromDsn($_ENV['MAILER_DSN']);
        $this->mailer = new Mailer($transport);
        try {
            $this->mailer->send($message);
        } catch (TransportExceptionInterface $transportException) {
            $transportException->getDebug();
        }
    }
}
