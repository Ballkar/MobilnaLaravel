<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ApiCommunication;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{
    use ApiCommunication;


    public function store(Request $request, User $user)
    {
        $request->validate(['avatar' => 'required|image']);

        if($user->avatar) {
//            $a = Storage::get('public\users\2\avatar\OkDm8LW3EL6kYR1iPxGTrFhPOgoXemplokSFYxSr.jpeg');
            Storage::delete('public\users\2\avatar\lT0y3EuPFJ5XqRRLvukinVrh2eFAnLebOxFKdnPI.jpeg');
//            Storage::delete($user->avatar_thumbnail);
        }
        $path = 'users/'.Auth::id().'/avatar';
        $avatar = $request->file('avatar');
        $file = Storage::put('public/'.$path, $avatar);

        $filename = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $avatar->getClientOriginalExtension();

        $thumbnailName = $filename.'_small.'.$extension;
        $thumbnail = $avatar->storeAs('public/'.$path, $thumbnailName);

        $thumbnailPath = public_path('storage/'.$path.'/'.$thumbnailName);
        $this->createThumbnail($thumbnailPath, 150, 93);

        $user->update([
            'avatar' => Storage::url($file),
            'avatar_thumbnail' => Storage::url($thumbnail),
        ]);



        return $this->sendResponse($user, 200);
    }

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

}
