<?php


namespace App\Services;

use App\Contracts\StorageServiceInterface;
use Illuminate\Support\Facades\Storage;

/**
 * Class StorageService
 * @package App\Services
 */
class StorageService implements StorageServiceInterface
{
    /**
     * Save file and return storage file path
     *
     * @param $file
     * @return string
     */
    public function save($file, $folder = '', $disk = 'public'): string
    {
       return Storage::disk($disk)->putFile($folder, $file);
    }

    /**
     * @param $path
     * @param string $disk
     * @return bool
     */
    public function delete($path, $disk = 'public') : bool
    {
        return Storage::disk($disk)->delete($path);
    }
}
