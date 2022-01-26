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
                            <th scope="col">Hinh ảnh</th>
                            <th scope="col">Tên truyện</th>
                            <th scope="col">Thể loại</th>
                            <th scope="col">Status</th>
                            <th scope="col">Manage</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($truyen as $key => $item)
                          <tr>
                            <th scope="row">{{$i++}}</th>
                            <td><img src="{{asset('public/uploads/truyen/'.$item->image)}}" width="100" height="100" alt=""></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->categories->title}}</td>
                            <td>
                              @if ($item->status == 1)
                                {{'Kích hoạt'}}
                              @else
                                {{'Khóa'}}
                              @endif
                            </td>
                            
                            <td style="display: flex;">
                              <form action="{{route('truyen.destroy',$item->id)}}" method="POST" onclick="return confirm('Bạn có muốn xóa truyện này không?');">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                              </form>
                              <a href="{{route('truyen.edit',$item->id)}}"><button type="button" class="btn btn-outline-warning">Update</button></a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection