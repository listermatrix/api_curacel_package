<?php

namespace Jetstream\Curacel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jetstream\Curacel\API\Interface\IAttachmentService;
use Jetstream\Curacel\DataObjects\AttachmentData;

class AttachmentController extends Controller
{
    private mixed $service;

    public function __construct()
    {
        $this->service = app(IAttachmentService::class);
    }

    public  function create(Request $request)
    {
        $data = $request->all();
        $data = array_merge($data,['file' => $request->file('file')]);
        $attachmentData = AttachmentData::from($data);
        return $this->service->createAttachment($attachmentData);
    }

    public  function download($id)
    {
        return $this->service->downloadAttachment($id);
    }


}
