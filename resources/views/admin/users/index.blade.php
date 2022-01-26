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
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Vai tro(Role)</th>
                            <th scope="col">quyen(Permissions)</th>
                            <th scope="col">Manage</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($users as $key => $item)
                          <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>Admin</td>
                            <td>Xem</td>
                            <td style="display: flex;">
                              <a href="{{route('phan.quyen',$item->id)}}" class="btn btn-outline-danger">Phan quyen</a>
                              <a href="#" class="btn btn-outline-danger">chuyen quyen nhanh</a>
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