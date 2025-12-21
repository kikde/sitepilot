<?php

namespace Dapunabi\Media\Events;

use Dapunabi\Media\Models\Media;

class MediaUploaded
{
    public function __construct(public Media $media) {}
}

