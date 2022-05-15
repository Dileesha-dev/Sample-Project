<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CompanyRepository{
    public function validateInput($request){
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'email|max:255|unique:users|nullable',
            'telephone' => 'max:10|nullable|regex:/(0)[0-9]{9}/',
            'website' => 'max:255|nullable',
            'covers' => 'nullable|max:4',
        ]);
        return null;
    }

    public function uploadImage($request, $type){
        if($type==Company::IS_LOGO){
            $diskName = 'public';
            $disk = Storage::disk($diskName);
            $path = $request->logo->store('logos/' . $request->id, $diskName);
            $url = $disk->url($path);
            return [
                'logo_path' => $path,
                'logo_url' => $url,
                'logo_disk' => $diskName,
            ];
        }
        else if($type==Company::IS_COVER){
            if ($request->hasfile('covers')) {
                $covers = $request->file('covers');

                $items = collect();
                foreach($covers as $cover) {
                    /* $name = $cover->getClientOriginalName();
                    $path = $cover->storeAs('covers', $name, 'public');
                    Log::info($name); */
                    $diskName = 'public';
                    $disk = Storage::disk($diskName);
                    $path = $cover->store('covers/' . $request->id, $diskName);
                    $url = $disk->url($path);
                    $items->push([
                        'cover_path' => $path,
                        'cover_url' => $url,
                        'cover_disk' => $diskName,
                    ]);
                }
                return $items;
             }
             return null;
        }
        else{
            return null;
        }
    }
}

?>