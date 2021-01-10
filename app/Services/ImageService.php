<?php

namespace App\Services;

use App\Helpers\PathHelper;
use App\Models\Image;
use Batch;
use Carbon\Carbon;
use File;
use Illuminate\Support\Collection;
use Intervention\Image\Facades\Image as Intervention;
class ImageService
{
    public const IMAGES_PATH = 'images';

    /** @var Image|Collection */
    protected $images;

    /** @var array */
    protected $imagesProcessed;

    /**
     * @param Image|Collection $images
     */
    public function __construct(Collection $images)
    {
        $this->images = $images;
    }

    /**
     * @return bool
     */
    public function loadAndSave(): bool
    {
        /** @var Collection|Image $image */
        foreach ($this->images as $image) {
            $filename = basename($image->url);

            $basePath  = PathHelper::build([storage_path('app/public'), self::IMAGES_PATH]);
            $fullPath = PathHelper::build([$basePath], $filename);

            if(!File::isDirectory($basePath) ) {
                File::makeDirectory($basePath, 493, true);
            }

            try {
                Intervention::make($image->url)->save($fullPath);
            } catch (\Exception $e) {
                \Log::error('ImageService: Error in processing image ' . $image->url);
                $this->pushToProcessed($image, null, Image::FAILED_STATUS);

                continue;
            }

            if (file_exists($fullPath)) {
                $this->pushToProcessed($image, $filename, Image::READY_STATUS);
            } else {
                $this->pushToProcessed($image, null, Image::FAILED_STATUS);

                continue;
            }
        }

        $this->updateRecords();

        return true;
    }

    private function pushToProcessed(Image $image, ?string $path, string $status)
    {
        $image->path   = $path;
        $image->status = $status;

        $this->imagesProcessed[] = [
            'id' => $image->id,
            'path' => $path,
            'status' => $image->status,
        ];
    }

    /**
     * @return bool
     */
    private function updateRecords(): bool
    {
        $instance = new Image;
        $updatedAt = new Carbon;

        array_map(function ($image) use ($updatedAt) {
            return array_merge($image, ['updated_at' => $updatedAt]);
        }, $this->imagesProcessed);

        $result = Batch::update($instance, $this->imagesProcessed, 'id');

        return $result ? true : false;
    }

    /**
     * @param Image $image
     *
     * @return string
     */
    public static function getPublicPath(Image $image): string
    {
        $basePath = PathHelper::build(['storage', self::IMAGES_PATH], $image->path);
        $fullPath = asset($basePath);

        return $fullPath;
    }
}
