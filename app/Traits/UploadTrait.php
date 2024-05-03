<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

trait UploadTrait
{

    public function verifyAndStoreImage(Request $request, $inputname, $foldername, $disk, $imageable_id, $imageable_type)
    {

        if ($request->hasFile($inputname)) {

            // Check img
            if (!$request->file($inputname)->isValid()) {
                session()->flash('error', 'Invalid Image!');
                return redirect()->back()->withInput();
            }

            $photo = $request->file($inputname);
            $name = \Illuminate\Support\Str::slug($request->input('name'));
            $filename = $name . '.' . $photo->getClientOriginalExtension();

            // insert Image
            $Image = new Image();
            $Image->filename = $filename;
            $Image->imageable_id = $imageable_id;
            $Image->imageable_type = $imageable_type;
            $Image->save();
            return $request->file($inputname)->storeAs($foldername, $filename, $disk);
        }

        return null;

    }

    public function Delete_attachment($disk, $path, $id)
    {

        Storage::disk($disk)->delete($path);
        image::where('imageable_id', $id)->delete();

    }

}