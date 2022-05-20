<?php


namespace App\Contracts;

interface FileExternalServiceInterface
{
    /**
     * return cropped file url
     *
     * @param $file
     * @return string
     */
    public function cropImage($file) : string;
}
