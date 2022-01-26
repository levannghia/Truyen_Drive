@extends('layout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('doc.truyen',$chapter->truyenTranh->slug)}}">{{$chapter->truyenTranh->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$chapter->title}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <h4>{{$chapter->truyenTranh->name}}</h4>
            <p>Chương hiện tại: {{$chapter->title}}</p>
            <div class="col-md-5 content">
                <style>
                    .isDiable{
                        color: currentColor;
                        opacity: 0.7;
                        pointer-events: none;
                        text-decoration: none;
                    }
                </style>
                <div class="form-group">
                    
                    <label for="">Chọn chương</label>
                    <p><a href="{{url('xem-chapter-truyen-tranh/'.$previous_chapter)}}" class="btn btn-success {{($chapter->id == $min_id->id) ? 'isDiable' : ''}}">Chương trước</a></p>
                    <select name="status" class="custom-select select-chapter">
                        @foreach ($all_chapter as $item)
                        <option value="{{$item->slug}}" {{$item->slug == $truyenTranh->slug ? 'selected' : ''}}>{{$item->title}}</option>
                        @endforeach
                    </select>
                    <p><a href="{{url('xem-chapter-truyen-tranh/'.$next_chapter)}}" class="mt-3 btn btn-success {{($chapter->id == $max_id->id) ? 'isDiable' : ''}}">Chương sau</a></p>
                </div>
                
            </div>
            <iframe src="https://drive.google.com/file/d/{{$chapter_content['basename']}}/preview" width="100%" height="580" allow="autoplay"></iframe>
            <hr>
        </div>
        <h3>Chia sẽ truyện</h3>    
    </div>
    <div class="fb-comments" data-href="{{URL::current()}}" data-width="" data-numposts="10"></div>
@endsection
@push('script')
    <script>
        $(document).ready( function(){
            $('.select-chapter').change(function(){
                var url = $(this).val();
                if(url){
                    window.location = url;
                }
            })
        })

        function current_chapter(){
            //chua su dung ham nay
            var url = window.location.href;
            $('.seclect-chapter').find('option[value="'+url+'"]').attr('selected',true);
        }
    </script>
@endpush()
