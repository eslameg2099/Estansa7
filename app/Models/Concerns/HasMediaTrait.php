<?php

namespace App\Models\Concerns;

use AhmedAliraqi\LaravelMediaUploader\Http\Controllers\MediaController;
use AhmedAliraqi\LaravelMediaUploader\Support\Uploader;
use Illuminate\Support\Arr;

trait HasMediaTrait
{
    /**
     * Upload File from base64 or multipart form data.
     *
     * @param string $key
     * @param string $collection
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function uploadFile(string $key, $collection = 'default')
    {
        $request = request();

        // Handle base64 that coming from request,
        // Like 'image_base64', upload and add to $collection.
        $files = Arr::wrap($request->$key);

        foreach ($files as $file) {
            if ($file && base64_decode(base64_encode($file)) === $file) {
                $this->addMediaFromBase64($file)
                    ->usingFileName(time().'.png')
                    ->toMediaCollection($collection);
            }
        }

        // Handle normal files that coming from request.
        if (is_array($files = $request->file($key))) {
            foreach ($files as $file) {
                $this->addMedia($file)
                    ->usingFileName(Uploader::formatName($file))
                    ->toMediaCollection($collection);
            }
        }

        // Handle normal files that coming from request.
        if (! is_array($file = $request->file($key)) && $request->hasFile($key)) {
            $this->addMediaFromRequest($key)
                ->usingFileName(Uploader::formatName($file))
                ->toMediaCollection($collection);
        }
    }
}
