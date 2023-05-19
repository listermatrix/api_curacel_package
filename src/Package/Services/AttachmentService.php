<?php

namespace Jetstream\Curacel\Package\Services;

use Jetstream\Curacel\Package\Config\CuracelApiConfig;
use Jetstream\Curacel\Package\Interface\IAttachmentService;
use Jetstream\Curacel\DataObjects\AttachmentData;

class AttachmentService extends CuracelApiConfig implements IAttachmentService
{
    private string $path;

    public function __construct()
    {
        parent::__construct();
        $this->path = '/attachments';
    }


    /**
     * @param AttachmentData $attachmentData
     * @return array
     */
    public function createAttachment(AttachmentData $attachmentData): array
    {
        return $this->postFile($this->path,$attachmentData->toArray());
    }

    /**
     * @param int $id
     * @return array
     */
    public function downloadAttachment(int $id): array
    {
        return $this->get("{$this->path}/$id");
    }
}
