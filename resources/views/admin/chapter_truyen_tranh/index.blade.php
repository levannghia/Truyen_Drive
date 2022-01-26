@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.nav')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Liệt kê truyện') }}</div>
                <div class="card-body">
                    @include('layouts.notification')
                    @php
                      $i = 1;
                    @endphp
                    <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên chapter</th>
                            <th scope="col">Tóm tắt</th>
                            <th scope="col">Thuộc truyện</th>
                            <th scope="col">Status</th>
                            <th scope="col">Manage</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (isset($listChapter))
                          @foreach ($listChapter as $key => $item)
                          <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$item->title}}</td>
                            <td>{{$item->summary}}</td>
                            <td>{{$item->truyens->name}}</td>
                            <td>
                              @if ($item->status == 1)
                                {{'Kích hoạt'}}
                              @else
                                {{'Khóa'}}
                              @endif
                            </td>
                            <td style="display: flex;">
                              <form action="{{route('chapter.destroy',$item->id)}}" method="POST" onclick="return confirm('Bạn có muốn xóa chapter này không?');">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                              </form>
                              <a href="{{route('chapter.edit',$item->id)}}"><button type="button" class="btn btn-outline-warning">Update</button></a>
                            </td>
                          </tr>
                          @endforeach
                          @endif
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection