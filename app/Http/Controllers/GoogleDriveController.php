<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use Google\Service\Storage as ServiceStorage;

class GoogleDriveController extends Controller
{
    public function newTruyenTranh(){
        Storage::disk('google')->makeDirectory('tenTruyen');
        dd('ok');
        //return redirect()->route('truyen-tranh.create')->with('message', 'Thêm thành công');
    }
}
