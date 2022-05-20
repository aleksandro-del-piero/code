<?php


namespace App\Services;

use App\Contracts\FileExternalServiceInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Tinify\Tinify;

/**
 * Class TinyImageCropService
 * @package App\Services
 */
class TinyImageCropService implements FileExternalServiceInterface
{
    /**
     * TinyImageCropService constructor.
     */
    public function __construct()
    {
        $this->setKey();
        $this->testConnectionService();
        $this->createFolderForCroppedImages();
    }

    /**
     * @param $file
     * @return string
     */
    public function cropImage($file) : string
    {
        $source = \Tinify\fromFile($file);

        $resized = $source->resize(array(
            "method" => config('image-crop.tinify.resize-method'),
            "width" => config('image-crop.tinify.resize-x'),
            "height" => config('image-crop.tinify.resize-y')
        ));

        $fileName = $this->getFileRandomName();

        $resized->toFile($this->getPathForCroppedImage() . $fileName);

        return $this->getCroppedFile($fileName);

    }

    /**
     * create folder for cropped images
     */
    public function createFolderForCroppedImages(): void
    {
        if (File::ensureDirectoryExists($this->getPathForCroppedImage())) {
            File::makeDirectory($this->getPathForCroppedImage());
        }
    }

    public function getFileRandomName()
    {
        return Str::random(10) . config('image-crop.tinify.extension');
    }

    /**
     * @return string
     */
    public function getPathForCroppedImage(): string
    {
        return public_path('storage' . DIRECTORY_SEPARATOR . config('image-crop.tinify.folder')) . DIRECTORY_SEPARATOR;
    }

    /**
     * @param $file
     * @return mixed|null
     */
    public function getExtension($file)
    {
        return $file->getClientOriginalExtension();
    }

    /**
     * @return string
     */
    public function getCroppedFile($fileName)
    {
        return URL::asset('storage' . '/' . config('image-crop.tinify.folder') . '/' . $fileName);
    }

    /**
     * @return string
     */
    public function getTinyToken(): string
    {
        return config('image-crop.tinify.token');
    }

    /**
     * test connection service
     *
     * @return bool
     * @throws \Tinify\AccountException
     */
    public function testConnectionService()
    {
        \Tinify\validate();
    }

    /**
     * set key service
     */
    public function setKey(): void
    {
        Tinify::setKey($this->getTinyToken());
    }
}
