<?php

namespace Dapunabi\Media\Jobs;

use Dapunabi\Media\Models\Media;
use Dapunabi\Media\Services\VariantGenerator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateVariants implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $mediaId;

    public function __construct(int $mediaId)
    {
        $this->mediaId = $mediaId;
        $this->onQueue('media');
    }

    public function handle(VariantGenerator $generator): void
    {
        $media = Media::find($this->mediaId);
        if (!$media || !$media->isImage()) return;
        $generator->generateImageVariants($media);
        // Dispatch variants generated event with current variant map
        try {
            $map = $media->variants()->get()->pluck('path','name')->toArray();
            event(new \Dapunabi\Media\Events\VariantsGenerated($media->id, $map));
        } catch (\Throwable $e) {}
    }
}
