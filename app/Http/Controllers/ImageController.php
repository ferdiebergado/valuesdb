<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        if ($request->get('file')) {
            $image = $request->get('file');
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('file'))->save(public_path('storage/avatars/') . $name);
        }

        return response()->json([
            'filename' => $name,
            'success' => 'You have successfully uploaded an image'
        ], 200);
    }
}
