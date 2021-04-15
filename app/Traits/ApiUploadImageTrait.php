<?php
namespace App\Traits;
use Intervention\Image\Facades\Image;
/**
 * Handling upload images.
 */
trait ApiUploadImageTrait
{
    public function uploadImage($image, $uploadPath) {
        $position = strpos($image, ';');
        $sub = substr($image, 0, $position);
        $ext = explode('/', $sub)[1];
        $imageName = time(). '.' .$ext;
        $path = $uploadPath. '/' . $imageName;
        $img = Image::make($image);
        // Resize the image to a width of 300 and constrain aspect ratio (auto height).
        $img->resize(300, 200, function ($constraint) {
            $constraint->aspectRatio();
        });
        // 50 for compress image to half.
        $img->save(public_path($path));
        return $path;
    }

    public function removeImage($imagePath) {
        if (!is_null($imagePath) && file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}
