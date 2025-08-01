<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Botble\Media\RvMedia;


if (!function_exists('upload_file')) {
    /**
     * @param int $limit
     * @param array $with
     * @return Collection
     */
    function upload_file($path='contact', $name = '', $file)
    {
        $extension = $file->getClientOriginalExtension();
        $tmp_name = $file->getClientOriginalName();
        $getMimeType = $file->getMimeType();
        $fileName = (!empty($name) ? $name : $tmp_name);
        $fileName = Str::slug(time() . '-'. $fileName) . '.' . $extension;;
        $dirUpload = public_path('storage') . '/' . $path;
        create_dir($dirUpload);
        $image = Image::make($file->getRealPath());
        $pathFileName = "$dirUpload/$fileName";
        $image->save($pathFileName);
        if (file_exists($pathFileName)) {
            return "$path/$fileName";
        }
        return "";
    }
}


if (!function_exists('create_dir')) {
    /**
     * @param string $directoryPath
     */
    function create_dir($directoryPath)
    {
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }
    }
}

if (!function_exists('get_media')) {

    function get_media($path_image)
    {
        if (!Storage::exists($path_image)) {
            return "";
        }
        return Storage::url($path_image);
    }
}

if (!function_exists('contain_extensions')) {

    function contain_extensions($str, array $arr) {
        foreach($arr as $a) {
            if (stripos($str,$a) !== false) return true;
        }
        return false;
    }
}
