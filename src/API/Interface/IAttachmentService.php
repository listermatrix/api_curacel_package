<?php

namespace Jetstream\Curacel\API\Interface;

use Jetstream\Curacel\DataObjects\AttachmentData;

interface IAttachmentService
{
    public function createAttachment(AttachmentData $attachmentData);
    public function downloadAttachment(int $id);
}
