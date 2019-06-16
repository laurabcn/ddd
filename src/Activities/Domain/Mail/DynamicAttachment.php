<?php
declare(strict_types=1);

namespace App\Activities\Domain\Mail;

class DynamicAttachment
{
    protected $body;
    protected $contentType;
    protected $filename;

    /**
     * DynamicAttachment constructor.
     *
     * @param $body
     * @param $contentType
     * @param $filename
     */
    public function __construct($body, $contentType, $filename)
    {
        $this->body = $body;
        $this->contentType = $contentType;
        $this->filename = $filename;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }
}
