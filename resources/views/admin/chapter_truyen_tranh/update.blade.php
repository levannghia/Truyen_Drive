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
                        @if (isset($chapter))
                        <form action="{{ route('chapter.update',$chapter->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Title</label>
                                <input type="text" name="title" value="{{$chapter->title}}" onkeyup="changeToString()"
                                    class="form-control" id="slug">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Slug</label>
                                <input type="text" name="slug" value="{{ $chapter->slug }}" class="form-control"
                                    id="convert_slug">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Tóm tắt</label>
                                <textarea name="summary" class="form-control" id="exampleFormControlTextarea1"
                                    rows="3">{{ $chapter->summary }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Nội dung</label>
                                <textarea name="content" class="form-control" id="chapterContent"
                                    rows="5">{{ $chapter->content }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Danh mục truyện</label>
                                <select class="form-select form-select-sm" name="truyen_id">
                                    @if (isset($listTruyen))
                                        @foreach ($listTruyen as $item)
                                            <option value="{{ $item->id }}" {{$chapter->truyens->id == $item->id ? 'selected' : ''}}>{{ $item->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Status</label>
                                <select class="form-select form-select-sm" name="status">
                                    <option value="1" @if ($chapter->status == 1) {{ 'selected' }} @endif>Kích hoạt</option>
                                    <option value="2" @if ($chapter->status == 2) {{ 'selected' }} @endif>Khóa</option>
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
