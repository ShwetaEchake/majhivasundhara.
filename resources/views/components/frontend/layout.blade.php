<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? 'माझी वसुंधरा' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="thane, mahanagar, palika, majhi vasundhara" />
    <meta name="keywords" content="thane, mahanagar, palika, majhi vasundhara" />
    <meta content="माझी वसुंधरा" name="author" />
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}" />
    <!-- css -->

    <link href="{{ asset('frontend/form/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/css/colors/red.css') }}" rel="stylesheet" id="color-opt">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('frontend/video_popup/video.popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/image_popup/style.css') }}">

</head>

@stack('styles')

<body>

    <x-frontend.header />



    {{ $slot }}



    @if (!request()->routeIs('contests.create') && !request()->routeIs('contests.paryavaran-dut'))
        <div class="footer-alt">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-start pull-none ">
                            <p class="copy-rights text-muted">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Content owned by TMC Administration © TMC, Thane - Designed & Developed by Core Ocean Solutions LLP
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- </div> --}}

    <!-- end Style switcher -->
    <script src="{{ asset('frontend/form/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/form/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/form/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('frontend/video_popup/video.popup.js') }}"></script>
    <script src="{{ asset('frontend/image_popup/jquery.image-popup.js') }}"></script>
    <script>
        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
            });
        });
        window.addEventListener('validate:scroll-to', (ev) => {
            ev.stopPropagation();
            let selector = ev?.detail?.query;
            if (!selector) {
                return;
            }
            console.log(selector);
            $('html, body').animate({
                scrollTop: $(selector).offset().top - 50
            }, 1000);

        }, false);
    </script>





    <script>
        $(document).ready(function(){
            $(function () {
                $('[data-toggle="tooltip"]').tooltip({container: 'body', boundary: 'window'})
            })
        });

        // INITIALIZE VIDEO POPUP
        $(".video-pop").videoPopup({
            autoplay:false,
            showControls:true,
            controlsColor:null,
            loopVideo:false,
            showVideoInformations:true,
            width:null
        });

        // INITIALIZE IMAGE POPUP
        $(".imageGallery").imagePopup({
            closeButton:{
                src: "{{ asset('frontend/image_popup/close.png') }}",
                width: "30px",
                height:"30px"
            },
            imageBorder: "15px solid #ffffff",
            borderRadius: "10px",
            imageWidth: "500px",
            imageHeight: "400px",
            imageCaption: {
                exist: true,
                color: "#ffffff",
                fontSize: "40px"
            },
            open: function(){
                // console.log("opened");
            },
            close: function(){
                // console.log("closed");
            }
        });
    </script>

</body>

@stack('scripts')

</html>
