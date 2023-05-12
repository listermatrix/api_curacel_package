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

        $attachmentData = new AttachmentData($request->file('file'),$request->input('description'));
        return $this->service->createAttachment($attachmentData);
    }

    public  function download($id)
    {
        return $this->service->downloadAttachment($id);
    }


}
