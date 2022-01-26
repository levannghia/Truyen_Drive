@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.nav')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Thêm chapter') }}</div>
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
                        <form action="{{ route('chapter.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Title</label>
                                <input type="text" name="title" value="{{ old('title') }}" onkeyup="changeToString()"
                                    class="form-control" id="slug">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Slug</label>
                                <input type="text" name="slug" value="{{ old('slug') }}" class="form-control"
                                    id="convert_slug">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Tóm tắt</label>
                                <textarea name="summary" class="form-control" id="exampleFormControlTextarea1"
                                    rows="3">{{ old('summary') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Nội dung</label>
                                <textarea name="content" class="form-control" id="chapterContent"
                                    rows="5">{{ old('content') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Truyện</label>
                                <select class="form-select form-select-sm" name="truyen_id">
                                    @if (isset($listTruyen))
                                        @foreach ($listTruyen as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
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
