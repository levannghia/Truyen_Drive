@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.nav')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cập nhật danh mục') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (isset($category))
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
                            <form action="{{ route('category.update', $category->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Title</label>
                                    <input type="text" value="{{ $category->title }}" onkeyup="changeToString()" name="title" class="form-control"
                                        id="slug" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Slug</label>
                                    <input type="text" value="{{ $category->slug }}" name="slug" class="form-control"
                                        id="convert_slug" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Mô tả</label>
                                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1"
                                        rows="3">{{ $category->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Status</label>
                                    <select class="form-select form-select-sm" name="status"
                                        aria-label="form-select-sm example">
                                        <option value="1" @if ($category->status == 1) {{ 'selected' }} @endif>Kích hoạt</option>
                                        <option value="2" @if ($category->status == 2) {{ 'selected' }} @endif>Khóa</option>
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
