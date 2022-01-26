@extends('layouts.app')

@section('content')
<div class="container">
  @include('layouts.nav')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Liệt kê danh mục') }}</div>
                
                <div class="card-body">
                    @include('layouts.notification')
                    @php
                      $i = 1;
                    @endphp
                    <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Manage</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($category as $key => $item)
                          <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$item->title}}</td>
                            <td>{{$item->description}}</td>
                            <td>
                              @if ($item->status == 1)
                                {{'Kích hoạt'}}
                              @else
                                {{'Khóa'}}
                              @endif
                            </td>
                            <td style="display: flex;">
                              @can('delete category')
                                
                             
                              <form action="{{route('category.destroy',$item->id)}}" method="POST" onclick="return confirm('Bạn có muốn xóa danh mục này không?');">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                              </form>
                              <a href="{{route('category.edit',$item->id)}}"><button type="button" class="btn btn-outline-warning">Update</button></a>
                              @endcan
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