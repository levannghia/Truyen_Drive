<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Truyen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
class TruyenController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $truyen = Truyen::with('categories')->get();
        return view('admin.truyen.index',compact('truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.truyen.create', compact('category'));
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
            'name' => 'required|unique:truyens|max:255',
            'slug' => 'required|unique:truyens|max:255',
            'status' => 'required',
            'summary' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:5000|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'category_id' => 'required'
        ]);

        $truyen = new Truyen();

        $truyen->name = $request->name;
        $truyen->tag = $request->tag;
        $truyen->summary = $request->summary;
        $truyen->status = $request->status;
        $truyen->category_id = $request->category_id;
        $truyen->slug = $request->slug;
        $truyen->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $truyen->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->image;
        if(isset($get_image)){
            $path = 'public/uploads/truyen/';
            $get_name_image =  $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.Str::random(10).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $truyen->image = $new_image;
        }
        if($truyen->save()){
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
        $truyen = Truyen::with('categories')->where('id',$id)->first();
        return view('admin.truyen.update', compact('truyen','category'));
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
        $truyen = Truyen::find($id);
        $this->validate($request,[
            'name' => 'required|max:255|unique:truyens,name,'.$truyen->id,
            'slug' => 'required|max:255|unique:truyens,slug,'.$truyen->id,
            'status' => 'required',
            'summary' => 'required',
            'image' => 'mimes:jpg,png,jpeg,gif,svg|max:5000|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'category_id' => 'required'
        ]);

        

        $truyen->name = $request->name;
        $truyen->summary = $request->summary;
        $truyen->tag = $request->tag;
        $truyen->status = $request->status;
        $truyen->category_id = $request->category_id;
        $truyen->slug = $request->slug;
        $truyen->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->image;
        if(isset($get_image)){
            $path = 'public/uploads/truyen/'.$truyen->image;
            if(file_exists($path)){
                unlink($path);
            }
            $path = 'public/uploads/truyen/';
            $get_name_image =  $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.Str::random(10).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $truyen->image = $new_image;
        }
        if($truyen->save()){
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
    public function destroy($id)
    {
        $truyen = Truyen::find($id);
        if($truyen){
            $path = 'public/uploads/truyen/'.$truyen->image;
            if(file_exists($path)){
                unlink($path);
            }
            $truyen->delete();
            return redirect()->back()->with('message', 'Xóa thành công');
        }
        return redirect()->back()->with('message', 'Xóa thất bại');
    }
}
