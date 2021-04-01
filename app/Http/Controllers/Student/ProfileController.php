<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        return view('platform.profile.index')->with('user', $user);
    }

    public function save(Request $request)
    {
        $request->validate(['name' => 'required|string']);

        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->name = $request->name;
        $user->save();
        session()->flash('success_message', 'تم تحديث الملف الشخصي');
        return redirect()->back();
    }

    public function updateUserImage(Request $request)
    {
        $base64_image = $request->image;
        $extension = explode('/', mime_content_type($base64_image))[1];

        if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
            return response()->json([
                'error' => 'file_type'
            ], 422);
        }

        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $data = substr($base64_image, strpos($base64_image, ',') + 1);

            $data = base64_decode($data);
            $fileName = 'profiles/images/' . time() .  '.' . $extension;
            Storage::disk('public')->put($fileName, $data);
        }
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->avatar = $fileName;
        $user->save();
        return response()->json([
            'path' => $fileName
        ]);
    }

    public function removeUserImage(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $defaultImage = 'dummy/profile-img.png';
        $user->avatar = $defaultImage;
        $user->save();
        return response()->json([
            'path' => $defaultImage
        ]);
    }
}
