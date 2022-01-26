<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Sach Truyen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.1/css/all.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,400italic,300italic' rel='stylesheet'
        type='text/css'>
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/owl.theme.default.min.css') }}" rel="stylesheet">
    <style>
        a {
            text-decoration: none;

        }

        .switch_color {
            background: #181818;
            color: #fff;
        }

        .switch_color_light {
            background: #181818 !important;
            color: #000;
        }

    </style>

</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">Truyen123.com</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">@lang('lang.home')</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li> --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @lang('lang.category')
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($category as $item)
                                    <li><a class="dropdown-item"
                                            href="{{ route('danh.muc', $item->slug) }}">{{ $item->title }}</a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @lang('lang.genre')
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @lang('lang.languge')
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{url('lang/en')}}">Tiếng Anh</a></li>
                                <li><a class="dropdown-item" href="{{url('lang/vi')}}">Tiếng Việt</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form autocomplete="off" class="d-flex" method="GET" action="{{ route('search') }}">
                        @csrf
                        <input class="form-control me-2" type="search" id="keyword" name="search"
                            placeholder="Tên truyện, sách" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                        <div id="search_ajax"></div>

                        <select class="custom-select mr-sm-2" id="switch_color">
                            <option value="white">White</option>
                            <option value="black">Black</option>
                        </select>
                    </form>
                </div>
            </div>
        </nav>

        {{-- slide --}}
        @yield('slide')
        @yield('content')


        <footer class="text-muted">
            <div class="container">
                <p class="float-right">
                    <a href="#">Back to top</a>
                </p>
                <p>Album example is © Bootstrap, but please download and customize it for yourself!</p>
                <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a
                        href="../../getting-started/">getting started guide</a>.</p>
            </div>
        </footer>
    </div>
  
  <!-- Modal -->
  <div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body">
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=590530215089180&autoLogAppEvents=1"
        nonce="Y5Ru2jtR"></script>
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
       
        $("[data-id]").click(function(){
            $('#my_modal').modal('show');
            let truyen_id = $(this).attr('data-id');
            let _token = $('meta[name="csrf-token"]').attr('content');
            $(document).on('click','.modal-close',function(){
                $('#my_modal').modal('hide');
            })
            $.ajax({
                method: "POST",
                url: "{{route('view.ajax')}}",
                data:{_token:_token, truyen_id: truyen_id},
                success: function(data){
                    if(data.status){
                        //console.log(data);
                       $('.modal-body').html(data.data.summary);
                       $('.modal-title').html(data.data.name);
                    }
                }
            });
        });

        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })

        $(document).ready(function() {
            $('#keyword').keyup(function() {
                var query = $(this).val();

                if (query != '') {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        method: "POST",
                        url: "{{ url('/search-ajax') }}",
                        data: {
                            query: query,
                            _token: _token
                        },
                        success: function(data) {
                            $('#search_ajax').fadeIn();
                            $('#search_ajax').html(data);
                        }
                    });
                } else {
                    $('#search_ajax').fadeOut();
                }
            })

            $(document).on('click', '.li_serach_ajax', function() {
                $('#keyword').val($(this).text());
                $('#search_ajax').fadeOut();
            });

            if (localStorage.getItem('switch_color') !== null) {
                const data = localStorage.getItem('switch_color');
                const data_obj = JSON.parse(data);
                $(document.body).addClass(data_obj.class_1);
                $('.album').toggleClass(data_obj.class_2);
                $('.card-body').toggleClass(data_obj.class_1);
                $('ul .muc-luc-truyen > li > a').css('color', '#fff');

                $("select option[value='black']").attr("selected", "selected");
                //console.log(data_obj);
            }
            //doi mau template
            $('#switch_color').change(function() {
                $(document.body).toggleClass('switch_color');
                $('.album').toggleClass('switch_color_light');
                $('.card-body').toggleClass('switch_color');
                $('ul .muc-luc-truyen > li > a').css('color', '#fff');

                if ($(this).val() == 'black') {
                    var item = {
                        'class_1': 'switch_color',
                        'class_2': 'switch_color_light'
                    };

                    localStorage.setItem('switch_color', JSON.stringify(item));

                } else if ($(this).val() == 'white') {
                    localStorage.removeItem('switch_color');
                    $('ul .muc-luc-truyen > li > a').css('color', '#000');

                }
            })

        })
    </script>
    
    @stack('script')
</body>

</html>
