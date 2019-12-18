<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ApiCommunication;
use App\Http\Resources\User as UserResource;
use App\Models\User\User;
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
        $photo = $request->file('avatar');
        $extension = $photo->getClientOriginalExtension();
        $avatarName = time().'.'.$extension;
        $thumbnailName = time().'_small.'.$extension;

        try {
            if($user->avatar) {
                Storage::disk('public')->delete('public/'.$path.$user->avatar);
                Storage::disk('public')->delete('public/'.$path.$user->avatar_thumbnail);
            }

            $image = Image::make($photo);
            Storage::disk('local')->put('public/'.$path.$avatarName, (string) $image->encode());
            Storage::disk('local')->put('public/'.$path.$thumbnailName, (string) $image->encode());

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

    public function delete(Request $request, User $user)
    {
        $arr1 = explode(',', $user->avatar);
        $arr2 = explode(',', $user->avatar_thumbnail);
        $avatarName = end($arr1);
        $thumbnailName = end($arr2);

        try {
            Storage::disk('local')->delete('public/users/'.$user->id.'/avatar/'.$avatarName);
            Storage::disk('local')->delete('public/users/'.$user->id.'/avatar/'.$thumbnailName);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }

        $user->update(['avatar' => null, 'avatar_thumbnail' => null]);


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
