<?php

namespace App\Http\Controllers;

use App\Models\TruyenTranh;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ChapterTruyenTranh;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use File;


class TruyenTranhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $truyen = TruyenTranh::with('categories')->get();
        return view('admin.truyen_tranh.index',compact('truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.truyen_tranh.create',compact('category'));
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
            'name' => 'required|unique:truyentranhs|max:255',
            'slug' => 'required|unique:truyentranhs|max:255',
            'status' => 'required',
            'summary' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:5000|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'category_id' => 'required'
        ]);

        $truyenTranh = new TruyenTranh();

        $truyenTranh->name = $request->name;
        $truyenTranh->tag = $request->tag;
        $truyenTranh->summary = $request->summary;
        $truyenTranh->status = $request->status;
        $truyenTranh->category_id = $request->category_id;
        $truyenTranh->slug = $request->slug;
        $truyenTranh->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $truyenTranh->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        //them folder vao gg drive
        Storage::disk('google')->makeDirectory($truyenTranh->slug);
        //lay id_folder tren gg drive
        $info = collect(Storage::disk('google')->listContents('/',false))->where('type','dir')->where('name',$truyenTranh->slug)->first();
        $truyenTranh->id_folder =  $info['path'];
        $get_image = $request->image;
        if(isset($get_image)){
            $path = 'public/uploads/truyen_tranh/';
            $get_name_image =  $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.Str::random(10).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $truyenTranh->image = $new_image;
        }
        if($truyenTranh->save()){
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
        $category = Category::all();
        $truyen = TruyenTranh::with('categories')->where('id',$id)->first();
        return view('admin.truyen_tranh.update', compact('truyen','category'));
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
        $truyen = TruyenTranh::find($id);
        $this->validate($request,[
            'name' => 'required|max:255|unique:truyentranhs,name,'.$truyen->id,
            'slug' => 'required|max:255|unique:truyentranhs,name,'.$truyen->id,
            'status' => 'required',
            'summary' => 'required',
            'image' => 'mimes:jpg,png,jpeg,gif,svg|max:5000|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'category_id' => 'required'
        ]);

      
        $folderInfor = collect(Storage::disk('google')->listContents('/',false))->where('type','dir')->where('name',$truyen->slug)->first();
        $truyen->name = $request->name;
        $truyen->summary = $request->summary;
        $truyen->tag = $request->tag;
        $truyen->status = $request->status;
        $truyen->category_id = $request->category_id;
        $truyen->slug = $request->slug;
        $truyen->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->image;
        if(isset($get_image)){
            $path = 'public/uploads/truyen_tranh/'.$truyen->image;
            if(file_exists($path)){
                unlink($path);
            }
            $path = 'public/uploads/truyen_tranh/';
            $get_name_image =  $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.Str::random(10).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $truyen->image = $new_image;
        }
        if($truyen->save()){
            Storage::disk('google')->move($folderInfor['path'],$truyen->slug);
            return redirect()->back()->with('message', 'Cập nhật thành công');
        }else{
            return redirect()->back()->with('message', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $truyenTranh = TruyenTranh::where('slug',$slug)->first();
        $folder = collect(Storage::disk('google')->listContents('/',false))->where('type','dir')->where('name',$slug)->first();
        
        if($truyenTranh){
            $path = 'public/uploads/truyen_tranh/'.$truyenTranh->image;
            if(file_exists($path)){
                unlink($path);
            }
            $truyenTranh->delete();
            Storage::disk('google')->delete($folder['path']);
            
            $chapter = ChapterTruyenTranh::where('truyen_tranh_id',$truyenTranh->id)->delete();
            return redirect()->back()->with('message', 'Xóa thành công');
        }
        return redirect()->back()->with('message', 'Xóa thất bại');
    }
}
