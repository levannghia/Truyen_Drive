<?php

namespace App\Http\Controllers;

use App\Models\ChapterTruyenTranh;
use App\Models\TruyenTranh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ChapterTruyenTranhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listTruyenTranh = TruyenTranh::all();
        return view('admin.chapter_truyen_tranh.create',compact('listTruyenTranh'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|unique:chapter_truyen_tranh|max:255',
            'slug' => 'required|unique:chapter_truyen_tranh|max:255',
            'status' => 'required',
            'summary' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg',
            'truyen_tranh_id' => 'required'
        ]);

        $chapterTruyenTranh = new ChapterTruyenTranh();

        $chapterTruyenTranh->title = $request->title;
        $chapterTruyenTranh->summary = $request->summary;
        $chapterTruyenTranh->status = $request->status;
        $chapterTruyenTranh->truyen_tranh_id = $request->truyen_tranh_id;
        $chapterTruyenTranh->slug = $request->slug;
        $chapterTruyenTranh->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $chapterTruyenTranh->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->image;
        
            
        
            
           
        if($chapterTruyenTranh->save()){
            $fileName = $request->slug;
            $fileData = File::get($get_image->path());
            $truyenTranh = ChapterTruyenTranh::with('truyenTranh')->where('truyen_tranh_id', $request->truyen_tranh_id)->first();
            // dd($truyenTranh->truyenTranh->id_folder);
            // $new_folder_chapter = Storage::disk('google')->makeDirectory('/'.$truyenTranh->truyenTranh->id_folder.'/'.$request->slug);
            // dd($new_folder_chapter);
            Storage::disk('google')->put('/'.$truyenTranh->truyenTranh->id_folder.'/'.$fileName, $fileData);
            // return redirect()->route('gg.new.folder',$truyenTranh->id);
            return redirect()->back()->with('message', 'Thêm thành công');
            
        }else{
            return redirect()->back()->with('message', 'Thêm thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
