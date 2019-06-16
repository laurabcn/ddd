<?php
declare(strict_types=1);

namespace App\Activities\Domain\Mail;

class Mail
{
    /**
     * @var string
     */
    private $emailFrom;

    /**
     * @var string
     */
    private $nameFrom;

    /**
     * @var string
     */
    private $subject;

    /**
     * array(array(to1@email.com => "To 1 Name"),array(to2@email.com)).
     *
     * @var array
     */
    private $to;
    /**
     * array(array(to1@email.com => "To 1 Name"),array(to2@email.com)).
     *
     * @var array
     */
    private $cc;

    /**
     * array(array(to1@email.com => "To 1 Name"),array(to2@email.com)).
     *
     * @var array
     */
    private $bcc;

    /**
     * replyTo@email.com.
     *
     * @var string
     */
    private $replyTo;

    /**
     * @var string
     */
    private $templateName;

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var array
     */
    private $attachmentFiles;

    /**
     * @var array
     */
    private $dynamicAttachments;

    public function __construct($templateName, $locale)
    {
        $this->locale = $locale;
        $this->templateName = $templateName;
        $this->to = [];
        $this->bcc = [];
        $this->cc = [];
        $this->data = [];
        $this->attachmentFiles = [];
        $this->dynamicAttachments = [];
    }

    /**
     * @param array $bcc
     */
    public function setBcc($bcc)
    {
        $this->bcc = $this->normalizeEmails($bcc);
    }

    /**
     * @return array
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @param array $cc
     */
    public function setCc($cc)
    {
        $this->cc = $this->normalizeEmails($cc);
    }

    /**
     * @return array
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @param string $replyTo
     */
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;
    }

    /**
     * @return string
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getTemplateName()
    {
        return $this->templateName;
    }

    /**
     * @param array $to
     */
    public function setTo($to)
    {
        $this->to = $this->normalizeEmails($to);
    }

    /**
     * @return array
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param string $emailFrom
     */
    public function setEmailFrom($emailFrom)
    {
        $this->emailFrom = $emailFrom;
    }

    /**
     * @return string
     */
    public function getEmailFrom()
    {
        return $this->emailFrom;
    }

    /**
     * @param string $nameFrom
     */
    public function setNameFrom($nameFrom)
    {
        $this->nameFrom = $nameFrom;
    }

    /**
     * @return string
     */
    public function getNameFrom()
    {
        return $this->nameFrom ? $this->nameFrom : $this->emailFrom;
    }

    /**
     * @param array $data
     */
    public function addData($data)
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data ? $this->data : [];
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function countryCode()
    {
        return $this->countryCode;
    }

    /**
     * Empty all possible recipients (to, cc, bcc).
     */
    public function emptyRecipients()
    {
        $this->to = [];
        $this->cc = [];
        $this->bcc = [];
    }

    /**
     * Normaliza una cadena de emails o un array de emails a un formato válido.
     */
    protected function normalizeEmails($addresses)
    {
        //TODO Aassert format
        return $addresses;
    }

    /**
     * @return array
     */
    public function getAttachmentFiles()
    {
        return $this->attachmentFiles;
    }

    /**
     * @param $path
     */
    public function addAttachmentFile($path)
    {
        $this->attachmentFiles[] = $path;
    }

    /**
     * @return array|DynamicAttachment
     */
    public function getDynamicAttachments()
    {
        return $this->dynamicAttachments;
    }

    /**
     * @param DynamicAttachment $dynamicAttachment
     */
    public function addDynamicAttachment(DynamicAttachment $dynamicAttachment)
    {
        $this->dynamicAttachments[] = $dynamicAttachment;
    }
}
