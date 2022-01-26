<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Truyen;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listChapter = Chapter::with('truyens')->orderBy('id','DESC')->get();
        return view('admin.chapter.index', compact('listChapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listTruyen = Truyen::all();
        return view('admin.chapter.create', compact('listTruyen'));
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
            'title' => 'required|unique:chapters|max:255',
            'slug' => 'required|unique:chapters|max:255',
            'status' => 'required',
            'summary' => 'required',
            'content' => 'required',
            'truyen_id' => 'required'
        ]);

        $chapter = new Chapter();

        $chapter->title = $request->title;
        $chapter->summary = $request->summary;
        $chapter->status = $request->status;
        $chapter->truyen_id = $request->truyen_id;
        $chapter->slug = $request->slug;
        $chapter->content = $request->content;
        
        if($chapter->save()){
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
        $listTruyen = Truyen::all();
        $chapter = Chapter::with('truyens')->where('id',$id)->first();
        return view('admin.chapter.update', compact('listTruyen','chapter'));
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
        $chapter = Chapter::findOrFail($id);
        $this->validate($request,[
            'title' => 'required|max:255|unique:chapter,title,'.$chapter->id,
            'slug' => 'required|max:255|unique:chapter,title,'.$chapter->id,
            'status' => 'required',
            'summary' => 'required',
            'content' => 'required',
            'truyen_id' => 'required'
        ]);

        

        $chapter->title = $request->title;
        $chapter->summary = $request->summary;
        $chapter->status = $request->status;
        $chapter->truyen_id = $request->truyen_id;
        $chapter->slug = $request->slug;
        $chapter->content = $request->content;
        
        if($chapter->save()){
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
        $chapter = Chapter::findOrFail($id);
        if($chapter){
            return redirect()->back()->with('message', 'Xóa thành công');
        }
        return redirect()->back()->with('message', 'Xóa thất bại');
    }
}
