<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EmployeeRepository{
    public function validateInput($request){
        $request->validate([
            'profile_photo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'email|max:255|unique:users|nullable',
            'phone' => 'max:10|nullable|regex:/(0)[0-9]{9}/'
        ]);
        return null;
    }

    public function uploadImage($request){
            $diskName = 'public';
            $disk = Storage::disk($diskName);
            $path = $request->profile_photo->store('profile_photo/' . $request->id, $diskName);
            $url = $disk->url($path);
            return [
                'profile_photo_path' => $path,
                'profile_photo_url' => $url,
                'profile_photo_disk' => $diskName,
            ];
    }
}

?>