@extends('layout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('danh.muc', $truyen->categories->slug) }}">{{ $truyen->categories->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $truyen->name }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3">
                    <img class="image-truyen" src="{{ asset('public/uploads/truyen/' . $truyen->image) }}" alt="">
                </div>
                <div class="col-md-9">
                    <style>
                        .info-truyen {
                            list-style: none;
                        }

                    </style>
                    <ul class="info-truyen">
                        <li>Tên truyện: {{ $truyen->name }}</li>
                        <li>Thoi gian dang: {{ $truyen->created_at->diffForHumans() }}</li>
                        <li>Danh muc: <a
                                href="{{ route('danh.muc', $truyen->categories->slug) }}">{{ $truyen->categories->title }}</a>
                        </li>
                        <li>
                            Số chapter: {{ count($chapter) }}
                            <button class="btn btn-danger btn_thich_truyen"><i class="fa fa-heart"
                                    aria-hidden="true"></i> Thich truyen</button>
                        </li>

                        @if (isset($chapter_first))
                            <li><a href="">Xem mục lục</a></li>
                            <li>
                                <a href="{{ route('xem.chapter', $chapter_first->slug) }}" class="btn btn-primary">Đọc
                                    online</a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                {!! $truyen->content !!}
            </div>
            <hr>
            <style>
                .tagcloud05 ul {
                    margin: 0;
                    padding: 0;
                    list-style: none;
                }

                .tagcloud05 ul li {
                    display: inline-block;
                    margin: 0 0 .3em 1em;
                    padding: 0;
                }

                .tagcloud05 ul li a {
                    position: relative;
                    display: inline-block;
                    height: 30px;
                    line-height: 30px;
                    padding: 0 1em;
                    background-color: #3498db;
                    border-radius: 0 3px 3px 0;
                    color: #fff;
                    font-size: 13px;
                    text-decoration: none;
                    -webkit-transition: .2s;
                    transition: .2s;
                }

                .tagcloud05 ul li a::before {
                    position: absolute;
                    top: 0;
                    left: -15px;
                    content: '';
                    width: 0;
                    height: 0;
                    border-color: transparent #3498db transparent transparent;
                    border-style: solid;
                    border-width: 15px 15px 15px 0;
                    -webkit-transition: .2s;
                    transition: .2s;
                }

                .tagcloud05 ul li a::after {
                    position: absolute;
                    top: 50%;
                    left: 0;
                    z-index: 2;
                    display: block;
                    content: '';
                    width: 6px;
                    height: 6px;
                    margin-top: -3px;
                    background-color: #fff;
                    border-radius: 100%;
                }

                .tagcloud05 ul li span {
                    display: block;
                    max-width: 100px;
                    white-space: nowrap;
                    text-overflow: ellipsis;
                    overflow: hidden;
                }

                .tagcloud05 ul li a:hover {
                    background-color: #555;
                    color: #fff;
                }

                .tagcloud05 ul li a:hover::before {
                    border-right-color: #555;
                }

            </style>
            @php
                $tag = explode(',', $truyen->tag);
            @endphp
            <p> Từ khóa tìm kiếm:
            <div class="tagcloud05">
                <ul>
                    @foreach ($tag as $value)
                        <li><a href="{{ url('/tag/' . Str::slug($value)) }}"><span>{{ $value }}</span></a></li>
                    @endforeach
                </ul>
            </div>
            </p>
            @if (count($chapter) > 0)
                <h4>Mục lục</h4>
                <ul class="muc-luc-truyen">
                    @foreach ($chapter as $item)
                        <li><a href="{{ route('xem.chapter', $item->slug) }}">{{ $item->title }}</a></li>
                    @endforeach
                </ul>
            @else
                <h4>Truyện đang cập nhật</h4>
            @endif
            @if (count($truyenSameCategory) > 0)
                <h4>truyện cùng danh mục</h4>
            @endif
            <div class="owl-carousel owl-theme">
                @foreach ($truyenSameCategory as $item)
                    <div class="item">
                        <img src="{{ asset('public/uploads/truyen/' . $item->image) }}" alt="">
                        <h3>{{ $item->name }}</h3>
                        <p><i class="fas fa-eye"></i> 60000</p>
                        <a href="{{ route('doc.truyen', $item->slug) }}" class="btn btn-danger btn-sm">Đọc ngay</a>
                    </div>
                @endforeach
            </div>
            <div class="fb-comments" data-href="{{ URL::current() }}" data-width="550" data-numposts="10"></div>
        </div>
        <div class="col-md-3">
            <h3>Danh mục truyện</h3>
            <h3>Truyen yeu thich</h3>
            <div id="wishlist_truyen"></div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {

            show_wishlist();

            function show_wishlist() {
                if (localStorage.getItem('wishlist_truyen') !== null) {
                    var data = JSON.parse(localStorage.getItem('wishlist_truyen'));
                    data.reverse() //dua data moi len dau
                    var i = 0;
                    const id_current = "{{ $truyen->id }}";
                    var matches = $.grep(data, function(obj) {
                        return obj.id == id_current;
                    });

                    if (matches.length) {
                        $('.fa.fa-heart').css('color', '#fac');
                    }

                    for (i = 0; i < data.length; i++) {
                        var name = data[i].name;
                        var url = data[i].url;
                        var img = data[i].img;
                        var id = data[i].id;

                        $('#wishlist_truyen').append(`
                                <div class="col-md-12">
                        <div class="card mb-4 box-shadow">
                            <a href="` + url + `">
                            <img class="card-img-top" src="` + img + `" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                            <div class="card-body">
                                <h3>` + name + `</h3>
                            </div>
                            </a>
                        </div>
                        </div>
                    `);
                    }
                }
            };

            // $(document).on('click','#delete_wishlist',function(){
            //     // alert("OK");
            //     let data1 = JSON.parse(localStorage.getItem('wishlist_truyen'));
            //     let id = $(this).attr("data-id");
            //     let matches = $.grep(data1, function(data) {
            //         return data.id == id;
            //     });
                
            //     if(matches.length){
            //         if(confirm("ban co chac muon xoa truyen khoi danh sach yeu thich") == true){
            //             var index = data1.indexOf(matches[0]) //tim vi tri phan tu can xoa
            //             var new_arr = data1.splice(index, 1); //xoa phan tu vua tim dk tai vi tri do
            //             localStorage.setItem('wishlist_truyen', JSON.stringify(data1));
            //             location.reload()
            //         }else{
            //             return false;
            //         }
            //     }
                
                    
                
            // });

            $('.btn_thich_truyen').click(function() {
                let css = $('.fa.fa-heart').css('color', '#fac');
                const id = "{{ $truyen->id }}";
                const name = "{{ $truyen->name }}";
                const img = $('.image-truyen').attr('src');
                const url = "{{ URL::current() }}";

                const item = {
                    'id': id,
                    'name': name,
                    'img': img,
                    'url': url
                }
                if (localStorage.getItem('wishlist_truyen') == null) {
                    localStorage.setItem('wishlist_truyen', '[]');
                }
                let old_data = JSON.parse(localStorage.getItem('wishlist_truyen'));
                let matches = $.grep(old_data, function(data) {
                    return data.id == id;
                });
                if (matches.length) {
                    
                    if(confirm("ban co chac muon xoa truyen khoi danh sach yeu thich") == true){
                        var index = old_data.indexOf(matches[0]) //tim vi tri phan tu can xoa
                        var new_arr = old_data.splice(index, 1); //xoa phan tu vua tim dk tai vi tri do
                    
                        location.reload()
                    }else{
                        return false;
                    }

                } else if (old_data.indexOf(matches) == -1) {
                    if (old_data.length <= 10) {
                        old_data.push(item);
                    } else {
                        alert('da dat gioi han yeu thich')
                    }

                    $('#wishlist_truyen').append(`
                    <div class="col-md-12">
              <div class="card mb-4 box-shadow">
                <a href="` + url + `">
                <img class="card-img-top" src="` + img + `" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                <div class="card-body">
                    <h3>` + name + `</h3>
                </div>
                </a>
              </div>
            </div>
                    `);

                    localStorage.setItem('wishlist_truyen', JSON.stringify(old_data));
                    alert('da them truyen vao danh sach yeu thich')
                }
                localStorage.setItem('wishlist_truyen', JSON.stringify(old_data));

            })
        })
    </script>
@endpush
