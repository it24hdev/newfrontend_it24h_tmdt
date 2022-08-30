<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <link href="{{asset('upload/images/common_img/icon-head.png')}}" rel="shortcut icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('asset/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/lib/OwlCarousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/lib/OwlCarousel/dist/assets/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="/asset/lib/fontawesomePro5/css/all.min.css" >
    <link rel="stylesheet" href="{{asset('asset/css/header-home.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/content-home.css')}}">
    @yield('css')
    <link rel="stylesheet" href="{{asset('asset/css/footer.css')}}">
    <!-- css -->
</head>

<body>
    <div id="wrapper-page">
        {{-- inclucde header --}}
        @yield('header-home')

        {{-- include menu mobile --}}
        @yield('header-mobile')
        <!-- backup top -->
        <a id="scroll_up" class="top-visible"><i class="fal fa-angle-up"></i></a>
        @yield('content')

        @yield('footer')
        <!-- Messenger Plugin chat Code -->

        <div id="zalo"><a href="https://zalo.me/" target="_blank">Zalo</a></div>
        <div id="hotline"><a href="tel:0886776286"><i class="fas fa-phone-alt"></i></a></div>
        <div id="messenger"><a href="https://m.me/106139498237028/" target="_blank"><i class="fab fa-facebook-messenger"></i></a></div>
    </div>
    <!-- javascript -->
    <script src="{{ asset('lib/jquery360.min.js') }}"></script>
    <script src="{{ asset('asset/lib/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/lib/OwlCarousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/js/home.js') }}"></script>
    @yield('js')
    <script>
        $(document).ready(function(){
            $("#login-ajax").click(function(){
                var email = $("#email-header").val();
                var password = $("#password-header").val();
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {email: email, password: password, _token: _token};
                if ($.trim(email) == ''){
                    alert('Bạn chưa nhập Email!');
                    return false;
                }

                if ($.trim(password) == ''){
                    alert('Bạn chưa nhập Mật khẩu');
                    return false;
                }
                $.ajax({
                    url: "{{route('user_login_ajax')}}",
                    data: data,
                    method: "POST",
                    dataType: "json",
                    success: function(data){
                        if(data.error){
                            $('.form-error-header').html("<div class='alert alert-danger' role='alert'>"+data.error+"</div>");
                        }
                        if(data.success){
                            window.location.href = "{{ route('user_account')}}";
                        }
                    }
                });
            });
            
        });
    </script>
    <script>
        $(document).ready(function(){
        $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

            function delay(callback, ms) {
              var timer = 0;
              return function() {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                  callback.apply(context, args);
                }, ms || 0);
              };
            }
            $("#searchs").keyup(delay(function(e){
                var keyword =  document.getElementById('searchs').value;
                console.log(keyword);
                $.ajax({
                        url:"{{route('autotypeahead')}}",
                        type:"post",
                        dataType:"json",
                        data:{
                            data: keyword,
                        } ,
                        success: function (data) {
                            var dt =  data.html;
                            $('.ajax-search-result').html('');
                            let result = dt.replaceAll("src_dt", "src");
                            $('.ajax-search-result').append(result);
                        },
                    })
                 document.getElementById("ajax-search").style.display = "block";
            },200));
            $("#select_cat").on("change", function(){
                location.replace('/san-pham/'+this.value);
            });
        });
    </script>
</body>

</html>
