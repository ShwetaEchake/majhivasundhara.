<x-frontend.layout>
    <x-slot name="title">माझी वसुंधरा | पयावरण दूत</x-slot>
    @livewireStyles()

    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/form/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css" integrity="sha512-QfDd74mlg8afgSqm3Vq2Q65e9b3xMhJB4GZ9OcHDVy1hZ6pqBJPWWnMsKDXM7NINoKqJANNGBuVRIpIJ5dogfA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            body{
                background-color: #f3fff9;
                -webkit-box-shadow: 0px 5px 62px 0px rgba(0, 0, 0, 0.19);
                        box-shadow: 0px 5px 62px 0px rgba(0, 0, 0, 0.19);
            }
            textarea{
                border: 1px solid #ccc !important;
                padding: 8px !important;
                background-color: #fff !important;
            }
            .form-check{
                padding-left: 0rem !important;
            }
            .form-control.is-invalid{
                border-color: #dc3545 !important;
            }
        </style>
    @endpush

    <div class="question-top-bg-img">
        <img src="{{ asset('frontend/images/grass_top.png') }}" class="img-fluid" alt="">
    </div>

        <div class="container-fluid px-5">

                @livewire('paryavaran-dut-form')
        </div>

    <div class="question-bottom-bg-img">
        <img src="{{ asset('frontend/images/grass_bottom.png') }}" class="img-fluid" alt="">
    </div>

    @push('scripts')
        <script src="{{ asset('frontend/form/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('frontend/form/popper.min.js') }}"></script>
        <script src="{{ asset('frontend/form/bootstrap.min.js') }}"></script>
        <script src="{{ asset('frontend/form/switch.js') }}"></script>
        <script src="{{ asset('frontend/form/main.js') }}"></script>

        <!-- Scroll To Top -->
        <script>
            $('.wizard-footer').on('click', '.js-btn-next', function (e) {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                return false;
            });
            $('.wizard-footer').on('click', '.js-btn-prev', function (e) {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                return false;
            });
        </script>

        <script>
            $("input[type='radio']").click(function(){
                var val = $(this).attr('data-mark');
                $(this).closest('.question-card').find('.selected-marks').text(val);
            })
        </script>
    @endpush

@livewireScripts()
</x-frontend.layout>
