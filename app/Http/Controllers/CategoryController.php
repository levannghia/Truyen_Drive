<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('permission:view category|edit category|add category|delete category', ['only'=> ['index','show']]);
        $this->middleware('permission:add category', ['only'=> ['create','store']]);
        $this->middleware('permission:delete category', ['only'=> ['destroy']]);
        $this->middleware('permission:edit category', ['only'=> ['edit', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories|max:255',
            'status' => 'required',
            'description' => 'required|max:255',
            
        ]);

        $category = Category::create($data);
        if($category){
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
        $category = Category::find($id);
        return view('admin.category.update', compact('category'));
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
        $data = $request->validate([
            'title' => 'required|max:255',
            'status' => 'required',
            'description' => 'required|max:255',
            'slug' => 'required|max:255'
        ]);
        
        if(Category::find($id)->update($data)){
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
        try {
            Category::find($id)->delete();
            return redirect()->back()->with('message', 'Xóa thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Xóa that bai');
        } 
    }
}
