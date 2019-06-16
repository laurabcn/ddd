<?php

namespace Colvin\Notification\Domain\Mail;

use Colvin\Notification\Domain\Mail\Exception\MailSentException;
use Colvin\Notification\Domain\Mail\Provider\MailerProviderInterface;
use Colvin\Notification\Domain\Mail\ValueObject\Mail;
use Psr\Log\LoggerInterface;

class Mailer
{
    /**
     * @var MailerProviderInterface
     */
    protected $mailerProvider;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(MailerProviderInterface $mailerProvider, LoggerInterface $logger)
    {
        $this->mailerProvider = $mailerProvider;
        $this->logger = $logger;
    }

    /**
     * @throws MailSentException
     */
    public function send(Mail $email): void
    {
        if (empty($email->getTo())) {
            throw new MailSentException('Email without recipients');
        }

        if (empty($email->getEmailFrom())) {
            throw new MailSentException('Email without sender');
        }

        try {
            $this->mailerProvider->send($email);

            $this->logger->info('Email has been sent', [
                'email_template' => $email->getTemplateName(),
            ]);
        } catch (\Throwable $t) {
            $this->logger->error('Email couldn\'t be sent', [
                'throwable' => $t,
                'email_template' => $email->getTemplateName(),
            ]);
            throw new MailSentException($t->getMessage(), 0, $t);
        }
    }
}
