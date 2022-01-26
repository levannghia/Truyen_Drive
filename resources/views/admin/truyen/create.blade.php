@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.nav')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Thêm truyện') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @include('layouts.notification')
                        <form action="{{ route('truyen.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" onkeyup="changeToString()"
                                    class="form-control" id="slug">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Slug</label>
                                <input type="text" name="slug" value="{{ old('slug') }}" class="form-control"
                                    id="convert_slug">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Tag</label>
                                <textarea name="tag" class="form-control"
                                    rows="3">{{ old('tag') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Tóm tắt</label>
                                <textarea name="summary" class="form-control" id="exampleFormControlTextarea1"
                                    rows="3">{{ old('summary') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Danh mục truyện</label>
                                <select class="form-select form-select-sm" name="category_id">
                                    @if (isset($category))
                                        @foreach ($category as $item)
                                        <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Hình ảnh</label>
                                <input class="form-control" type="file" id="formFile" onchange="previewFile(this);" name="image">
                            </div>
                            <img id="previewImage" src="" alt="" width="30%">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Status</label>
                                <select class="form-select form-select-sm" name="status">
                                    <option value="1" selected>Kích hoạt</option>
                                    <option value="2">Khóa</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script1')
    <script>
            //hien thi anh truoc khi update
            function previewFile(input){
                let file = $("#formFile").get(0).files[0];
                // console.log(file);
                if(file){
                    let reader = new FileReader();
                    console.log(reader);
                    reader.onload = function(){
                        $('#previewImage').attr("src",reader.result);
                    }
                    reader.readAsDataURL(file);
                }
            }
        
    </script>
@endpush
