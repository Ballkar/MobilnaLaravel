<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Resources\Announcement as AnnouncementResources;
use App\Http\Resources\User as UserResource;
use App\Models\Announcement;
use App\Models\Image as ImageModel;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{
    use ApiCommunication;


    public function index(Announcement $announcement)
    {
        $images = $announcement->images->map(function ($item) {
            $item['imageName'] = env('APP_URL').'/storage/announcements/'.$item->id.'/'.$item->imageName;
            return $item;
        });
        return $this->sendResponse($images, 200);
    }

    public function store(Request $request, Announcement $announcement)
    {
        $request->validate(['photo' => 'required|image']);
        $path = 'announcements/'.$announcement->id.'/';
        $photo = $request->file('photo');
        $extension = $photo->getClientOriginalExtension();
        $photoName = time().'.'.$extension;

        try {
            $image = Image::make($photo);
            Storage::put('public/'.$path.$photoName, (string) $image->encode());

            $image = ImageModel::create([
                'imageName' => $photoName,
                'imageable_id' => $announcement->id,
                'imageable_type' => Announcement::class,
            ]);

            if(!$announcement->main_image) {
                $announcement->main_image = $image->id;
                $announcement->save();
            }
            return $this->sendResponse($image, 200);
        } catch (Exception $e) {
            return $this->sendError( $e->getMessage(), 500);
        }
    }

    public function changeMainImage(Request $request, Announcement $announcement)
    {
        $request->validate(['main_id' => 'required|exists:images,id']);

        $announcement->main_image = $request->get('main_id');
        $announcement->save();
        return $this->sendResponse(new AnnouncementResources($announcement), 200);
    }

    public function delete(Request $request, Announcement $announcement, ImageModel $image)
    {
        try {
            Storage::delete('public/announcements/'.$announcement->id.'/'.$image->imageName);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
        $image->delete();

        return $this->sendResponse(true, 200);
    }

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }
}
