<?php

namespace App\Services;

class FileUploadProcessor
{
    public function upload($file)
    {
        try {
            $imageName = time() . '-' . $file->getClientOriginalName();
            $path = public_path('uploads');
            $file->move($path, $imageName);
            return url('/') . '/uploads/' . $imageName;
        } catch (Exception $ex) {
            return false;
        }

    }
}
