<?php

namespace Jetstream\Curacel\API\Services;

use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\API\Config\CuracelApiConfig;
use Jetstream\Curacel\API\Interface\IAttachmentService;
use Jetstream\Curacel\API\Interface\IClaimService;
use Jetstream\Curacel\API\Interface\ICustomerService;
use Jetstream\Curacel\DataObjects\AttachmentData;
use Jetstream\Curacel\DataObjects\ClaimData;
use Jetstream\Curacel\DataObjects\CuracelCustomer;
use Jetstream\Curacel\DataObjects\VoucherData;

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
     * @return mixed
     * @throws RequestException
     */
    public function createAttachment(AttachmentData $attachmentData): mixed
    {
        return $this->postFile($this->path,$attachmentData->toArray());
    }

    /**
     * @param int $id
     * @return mixed
     * @throws RequestException
     */
    public function downloadAttachment(int $id): mixed
    {
        return $this->get("{$this->path}/$id");
    }
}
