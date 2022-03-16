<?php

namespace App\Classes;

use Illuminate\Support\Facades\Request;

class FileControl
{
    public static function fileSave(Request $request, $folder, $name)
    {
        $newName = $name . '_' . uniqid() . '.' . $request->file($name)->extension();
        $request->file($name)->storeAs($folder, $newName);

        return $newName;
    }
}
