<?php
declare(strict_types=1);

namespace App\Activities\Domain\Mail;

use App\Activities\Domain\Activity\Activity;
use Symfony\Component\Translation\TranslatorInterface;

class DeliveredMailBuilder
{
    public static function buildMail(Activity $activity, string $email, TranslatorInterface $translator): Mail
    {
        $mail = new Mail('shipping_customerNotifications/delivered', 'ES');
        $mail->setTo([$email]);
        $mail->setSubject('Nova activitat creada');
        $mail->addData(['activity' => $activity]);
        $mail->setEmailFrom('laurariera9@gmail.com');
        $mail->setNameFrom('sortir.barcelona');

        return $mail;
    }
}
