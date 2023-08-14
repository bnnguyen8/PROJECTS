<?php
namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;

class UploadService
{
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                $name = Auth::id().'_'.$request->file('file')->getClientOriginalName();
                $pathFull = 'uploads/' . date("Ymd");

                $request->file('file')->storeAs(
                    'public/' . $pathFull, $name
                );

                // php artisan storage:link
                return '/storage/' . $pathFull . '/' . $name;
            } catch (\Exception $error) {
                return false;
            }
        }
    }
}


// use Illuminate\Support\Facades\Auth;
// $name = Auth::id() . '_' . date("YmdHis").'_'.$request->file('file')->getClientOriginalName();
// $folder =  'public/uploads_images';

// // https://laravel.com/docs/10.x/filesystem#specifying-a-file-name
// // config/filesystems.php -> 'public' -> 'url' => env('APP_URL').'/storage',
// // $request->file('file')->storeAs(
// //     'public/' . $pathFull, $name
// // );
// $path = $request->file('file')->store($folder);
// dd($path);