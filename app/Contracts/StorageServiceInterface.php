<?php

namespace App\Contracts;

/**
 * Interface StorageServiceInterface
 * @package App\Contracts
 */
interface StorageServiceInterface
{
    /**
     * Save file and return storage file path
     *
     * @param $file
     * @return string
     */
    public function save($file, $folder = '', $disk = 'public') : string;

    /**
     * Delete file from storage
     *
     * @param $path
     * @param string $disk
     * @return bool
     */
    public function delete($path, $disk = 'public') : bool;
}
