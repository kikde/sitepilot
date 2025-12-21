<?php

namespace Dapunabi\Media\Events;

class MediaDeleted
{
    public function __construct(public int $mediaId) {}
}

