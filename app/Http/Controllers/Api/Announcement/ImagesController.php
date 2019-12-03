<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Resources\Announcement as AnnouncementResources;
use App\Http\Resources\User as UserResource;
use App\Models\Announcement;
use App\Models\AnnouncementImage;
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
        $images = $announcement->images;
        return $this->sendResponse($images, 'Images returned');
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
            Storage::disk('public')->put('public/'.$path.$photoName, (string) $image->encode());

            AnnouncementImage::create([
                'name' => $photoName,
                'announcement_id' => $announcement->id,
                'main' => $announcement->images->isEmpty() ? true : false,
            ]);

            $announcement = $announcement->find($announcement->id);
            return $this->sendResponse($announcement->images, 'New image added');
        } catch (Exception $e) {
            return $this->sendError( $e->getMessage(), 500);
        }
    }

    public function changeMainImage(Request $request, Announcement $announcement)
    {
        $request->validate(['main_id' => 'required|exists:announcement_images,id']);

        if($old = $announcement->images->where('main', 1)->first()) {
            $old->update(['main' => false]);
        }

        $image = AnnouncementImage::where('id', $request->get('main_id'))->first();
        $image->update(['main' => true]);

        $announcement = $announcement->find($announcement->id);
        return $this->sendResponse(new AnnouncementResources($announcement), 'Main image changed');
    }

    public function delete(Request $request, Announcement $announcement, AnnouncementImage $image)
    {
        try {
            Storage::disk('public')->delete('public/announcements/'.$announcement->id.'/'.$image->name);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
        $image->delete();
        if($image->main && $differentImage = $announcement->images[0]) {
            $differentImage->update([
                'main' => true,
            ]);
        }

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
