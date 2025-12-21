<?php

namespace Dapunabi\Media\Events;

class VariantsGenerated
{
    /**
     * @param array<string,string> $variants name=>path
     */
    public function __construct(public int $mediaId, public array $variants = []) {}
}

