<?php

namespace App\Jobs;

use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class LoadImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Image|Collection */
    protected $images;

    /**
     * @param Image|Collection $images
     */
    public function __construct(Collection $images)
    {
        $this->images = $images;
    }

    public function handle()
    {
        $imageService = new ImageService($this->images);
        $imageService->loadAndSave();
    }
}
