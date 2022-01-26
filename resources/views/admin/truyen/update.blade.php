@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.nav')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cập nhật truyện') }}</div>

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
                        @if (isset($truyen))
                        <form action="{{ route('truyen.update',$truyen->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text" name="name" value="{{$truyen->name}}" onkeyup="changeToString()"
                                    class="form-control" id="slug">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Slug</label>
                                <input type="text" name="slug" value="{{ $truyen->slug }}" class="form-control"
                                    id="convert_slug">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Tag</label>
                                <textarea name="tag" class="form-control"
                                    rows="3">{{ $truyen->tag }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Tóm tắt</label>
                                <textarea name="summary" class="form-control" id="exampleFormControlTextarea1"
                                    rows="3">{{ $truyen->summary }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Danh mục truyện</label>
                                <select class="form-select form-select-sm" name="category_id">
                                    @if (isset($category))
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}" {{$truyen->categories->id == $item->id ? 'selected' : ''}}>{{ $item->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Hình ảnh</label>
                                <input class="form-control" type="file" id="formFile" name="image">
                                <img src="{{asset('public/uploads/truyen/'.$truyen->image)}}" width="200" height="200" alt="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Status</label>
                                <select class="form-select form-select-sm" name="status">
                                    <option value="1" @if ($truyen->status == 1) {{ 'selected' }} @endif>Kích hoạt</option>
                                    <option value="2" @if ($truyen->status == 2) {{ 'selected' }} @endif>Khóa</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
