<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ApiCommunication;
use App\Http\Resources\User as UserResource;
use App\Models\User;
use Exception;
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
        $path = 'users/'.$user->id.'/avatar/';
        $avatar = $request->file('avatar');
        $extension = $avatar->getClientOriginalExtension();
        $avatarName = time().'.'.$extension;
        $thumbnailName = time().'_small.'.$extension;

        try {
            if($user->avatar) {
                Storage::disk('public')->delete('public/'.$path.$user->avatar);
                Storage::disk('public')->delete('public/'.$path.$user->avatar_thumbnail);
            }

            $photo = Image::make($avatar);
            Storage::disk('public')->put('public/'.$path.$avatarName, (string) $photo->encode());
            Storage::disk('public')->put('public/'.$path.$thumbnailName, (string) $photo->encode());

            $thumbnailPath = public_path('storage/'.$path.'/'.$thumbnailName);
            $this->createThumbnail($thumbnailPath, 150, 93);

            $user->update([
                'avatar' => $avatarName,
                'avatar_thumbnail' => $thumbnailName,
            ]);
            return $this->sendResponse(new UserResource($user), 200);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

}
