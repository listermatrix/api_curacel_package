<?php

namespace Jetstream\Curacel\DataObjects;

use Spatie\LaravelData\Attributes\Validation\File;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AttachmentData extends  Data
{
    public function __construct(
        #[File]
        public UploadedFile $file,
        public string|Optional $description,
    ) {
    }
}
