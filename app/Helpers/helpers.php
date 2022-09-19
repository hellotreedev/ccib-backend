<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function fullPath($image)
    {
        return Storage::url($image);
    }
}