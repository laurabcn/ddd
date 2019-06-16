<?php

namespace Colvin\Notification\Domain\Mail\Provider;

use Colvin\Notification\Domain\Mail\ValueObject\Mail;

interface MailerProviderInterface
{
    public function send(Mail $mail);
}
