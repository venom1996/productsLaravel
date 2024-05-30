<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
class Picture
{
    private string $folderPath;


    public function __construct(string $folderPath)
    {
        $this->folderPath = $folderPath;
    }


    public function createImageFromBase64(string $baseFile) :string
    {
        $fileData = $baseFile;

        if ($fileData != '') {
            $save = Storage::put($this->folderPath, $fileData);

            if ($save) {
                return $this->folderPath;
            }
        }

        return  '';
    }

}
