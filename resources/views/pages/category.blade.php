@extends('layout')
@section('slide')
    @include('pages.slide')
@endsection
@section('content')
    <h3>{{$category_id->title}}</h3>
    <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
            @if (count($truyen) == 0)
                <p>Truyen dang cap nhat</p>
            @else
            @foreach ($truyen as $item)
            <div class="col-md-3">
              <div class="card mb-4 box-shadow">
                <a href="{{route('doc.truyen',$item->slug)}}">
                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="{{ asset('public/uploads/truyen/'.$item->image) }}" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                <div class="card-body">
                    <h3>{{$item->name}}</h3>
                  <p class="card-text"> {{substr($item->summary, 0,150) . "..."}}</p>
                </a>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button class="btn btn-sm btn-outline-secondary" data-id="{{$item->id}}" id="btn_view">Xem nhanh</button>
                      <a class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i> 60000</a>
                    </div>
                    <small class="text-muted">{{$item->created_at->diffForHumans()}}</small>
                  </div>
                </div>
                
              </div>
            </div>
            @endforeach
            @endif
          </div>
          <a href="#" class="btn btn-success">Xem tất cả</a>
        </div>
    </div>

       {{-- Blog --}}
    <h3>Blogs</h3>
    <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
            <div class="col-md-3">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="{{ asset('public/uploads/truyen/aomanchester2hgEzrpyTdd.jpg') }}" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                <div class="card-body">
                    <h3>This is a wider card with supporting text below</h3>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="#" class="btn btn-sm btn-outline-secondary">View</a>
                      <a class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i> 60000</a>
                    </div>
                    <small class="text-muted">9 phút trước</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <a href="#" class="btn btn-success">Xem tất cả</a>
        </div>
      </div>
@endsection