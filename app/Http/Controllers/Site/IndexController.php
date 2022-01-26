<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\ChapterTruyenTranh;
use App\Models\Truyen;
use App\Models\TruyenTranh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class IndexController extends Controller
{

    public function home()
    {
        $truyenTranh = TruyenTranh::orderBy('id','DESC')->where('status',1)->get();
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $truyen = Truyen::orderBy('id','DESC')->where('status',1)->get();
        return view('pages.home',compact('category','truyen','truyenTranh'));
    }
    public function danhMuc($slug)
    {
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $category_id = Category::where('slug',$slug)->first();
        $truyen = Truyen::orderBy('id','DESC')->where('status',1)->where('category_id',$category_id->id)->get();
        return view('pages.category',compact('category','category_id','truyen'));
    }
    public function docTruyen($slug)
    {
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $truyen = Truyen::where('slug',$slug)->where('status',1)->first();
        $chapter = Chapter::with('truyens')->where('status',1)->where('truyen_id',$truyen->id)->get();
        $chapter_first = Chapter::with('truyens')->orderBy('id','ASC')->where('status',1)->where('truyen_id',$truyen->id)->first();
        $truyenSameCategory = Truyen::where('category_id',$truyen->categories->id)->whereNotIn('id',[$truyen->id])->orderBy('id','DESC')->get();
        return view('pages.truyen_detail',compact('category','truyen','chapter','truyenSameCategory','chapter_first'));
    }

    public function docTruyenTranh($slug)
    {
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $truyenTranh = TruyenTranh::where('slug',$slug)->where('status',1)->first();
        $chapter = ChapterTruyenTranh::with('truyenTranh')->where('status',1)->where('truyen_tranh_id',$truyenTranh->id)->get();
        $chapter_first = ChapterTruyenTranh::with('truyenTranh')->orderBy('id','ASC')->where('status',1)->where('truyen_tranh_id',$truyenTranh->id)->first();
        $truyenSameCategory = TruyenTranh::where('category_id',$truyenTranh->categories->id)->whereNotIn('id',[$truyenTranh->id])->orderBy('id','DESC')->get();
        return view('pages.truyen_tranh_detail',compact('category','truyenTranh','chapter','truyenSameCategory','chapter_first'));
    }

    public function chapterTruyenTranh($slug)
    {
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $truyenTranh = ChapterTruyenTranh::where('slug',$slug)->first();
        $chapter = ChapterTruyenTranh::with('truyenTranh')->where('slug',$slug)->where('truyen_tranh_id',$truyenTranh->truyen_tranh_id)->first();
        $all_chapter = ChapterTruyenTranh::with('truyenTranh')->orderBy('id','ASC')->where('truyen_tranh_id',$truyenTranh->truyen_tranh_id)->get();
        $next_chapter = ChapterTruyenTranh::where('truyen_tranh_id',$truyenTranh->truyen_tranh_id)->where('id','>',$chapter->id)->min('slug');
        
        $min_id = ChapterTruyenTranh::where('truyen_tranh_id',$truyenTranh->truyen_tranh_id)->orderBy('id','ASC')->first();
        $max_id = ChapterTruyenTranh::where('truyen_tranh_id',$truyenTranh->truyen_tranh_id)->orderBy('id','DESC')->first();
        $previous_chapter = ChapterTruyenTranh::where('truyen_tranh_id',$truyenTranh->truyen_tranh_id)->where('id','<',$chapter->id)->max('slug');
        $chapter_content = collect(Storage::disk('google')->listContents('/'.$chapter->truyenTranh->id_folder.'/',false))->where('type','!=','dir')->where('name',$slug)->first();
        //return $chapter_content;
        return view('pages.chapter_truyen_tranh',compact('category','chapter','all_chapter','chapter_content','truyenTranh','next_chapter','previous_chapter','min_id','max_id'));
    }

    public function chapter($slug)
    {
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $truyen = Chapter::where('slug',$slug)->first();
        $chapter = Chapter::with('truyens')->where('slug',$slug)->where('truyen_id',$truyen->truyen_id)->first();
        $all_chapter = Chapter::with('truyens')->orderBy('id','ASC')->where('truyen_id',$truyen->truyen_id)->get();
        $next_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','>',$chapter->id)->min('slug');
        $min_id = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','ASC')->first();
        $max_id = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','DESC')->first();
        $previous_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','<',$chapter->id)->max('slug');
        
        return view('pages.chapter',compact('category','chapter','all_chapter','truyen','next_chapter','previous_chapter','min_id','max_id'));
    }

    public function searchAjax(Request $request){
        $data = $request->all();
        if($request->get('query')){
            $search = Truyen::where('name','LIKE','%'.$data['query'].'%')->where('status',1)->get();
            $outPut = '<ul class="dropdown-menu" style="display: block;">';
            foreach($search as $value){
                $outPut .= '<li style="display: flex; padding-bottom: 5px;"><img style="width:30px;" src="'.asset('public/uploads/truyen/'.$value->image).'" alt=""><a class="li_search_ajax" href="'.route('doc.truyen',$value->slug).'">'.$value->name.'</a></li>';
            }
            $outPut .= '</ul>';
            echo $outPut;
        }
    }

    public function viewAjax(Request $request){
        $data = $request->all();
        if($request->get('truyen_id')){
            $truyen = Truyen::where('id',$request->get('truyen_id'))->where('status',1)->first();
           if(isset($truyen)){
                return response()->json([
                    'status' => true,
                    'data' => $truyen,
                ]);
           }else{
            return response()->json([
                'status' => false,
                'msg' => 'get failed',
            ]);
           }
          
        }
    }
    public function search(Request $request){
        // if($request->query){
        //     $search = Truyen::where('name','LIKE','%'.$request->query.'%')->where('status',1)->get();
        //     $outPut = '<ul class="dropdown-menu" style="display: block;">';
        //     foreach($search as $value){
        //         $outPut .= '<li style="display: flex; padding-bottom: 5px;"><img style="width:30px;" src="'.asset('public/uploads/truyen/'.$value->image).'" alt=""><a style="color: whitesmoke;" class="dropdown-item" href="">'.$value->name.'</a></li>';
        //     }
        //     $outPut .= '</ul>';
        //     echo $outPut;
        // }
        $search = Truyen::where('name','LIKE','%'.$request->search.'%')->where('status',1)->get();
    }

    public function tag($tag)
    {
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $tags = explode("-", $tag);
        $truyen = Truyen::with('categories')->where(
            function ($query) use($tags){
                for($i = 0; $i<count($tags); $i++){
                    $query->orWhere('tag','LIKE','%'.$tags[$i].'%');
                }
            }
        )->paginate(12);
            //dd($truyen);
        return view('pages.tag', compact('category','truyen','tag'));
    }
}
