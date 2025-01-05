<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>माझी वसुंधरा - Field Login</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/feather-icon.css') }}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- Loader ends-->




    <div id="navbar" class="is-sticky">
        <nav class="navbar navbar-expand-lg navbar-custom sticky sticky-dark navbar-dark bg-dark">
            <div class="container px-md-5">
                <!-- LOGO -->
                <a class="navbar-brand logo text-uppercase py-0" href="{{ route('/') }}">
                    <img src="{{ asset('frontend/images/favicon.png') }}" alt="" class="img-fluid" style="width: 60px">
                    माझी वसुंधरा
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="nav-button ms-auto">
                        <ul class="nav navbar-nav navbar-end align-items-center">
                            <li>
                                <a data-scroll href="{{ route('/') }}" class="btn nav-link py-1">होम</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>



    <section>
        <div class="container-fluid p-0">
            <div class="row">

                @if( isset($success_message) )
                    <div class="alert alert-success" role="alert">
                        {{ $success_message }}
                    </div>
                @endif

                <div class="col-12">
                    <div class="login-card">
                        <form class="theme-form login-form" id="loginForm">
                            <div class="col-12 mb-4 text-center">
                                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="" style="height: 100px; width: auto" class="img-fluid">
                                {{-- <h4>Kalyan Dombivali Municipal Corporation</h4> --}}
                                <h4 class="mt-3">ठाणे महानगरपालिका माझी वसुंधरा</h4>
                            </div>
                            @csrf

                            <h4 class="text-center">लॉगिन (Field Login)</h4>

                            <br>
                            <div class="form-group">
                                <label>वापरकर्तानाव (Username)</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                    <input class="form-control" type="text" name="username" id="username" placeholder="वापरकर्तानाव (Username)">
                                </div>
                                <span class="text-danger error-text username_err"></span>
                            </div>

                            <div class="form-group">
                                <label>पासवर्ड (Password)</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" id="password" name="password" placeholder="*********">
                                    <span class="input-group-text" id="password_eye" onclick="showHidePassword1()"><i class="eye fa fa-eye-slash"></i></span>
                                </div>
                                <span class="text-danger error-text password_err"></span>
                            </div>

                            {{-- <div class="form-group">
                                <div class="checkbox">
                                    <input id="remember_me" name="remember_me" type="checkbox">
                                    <label for="remember_me">मला लॉगिन ठेवा</label>
                                </div>
                            </div> --}}

                            <div class="form-group d-flex justify-content-between">
                                {{-- <a class="" href="{{ route('register') }}">येथे नोंदणी करा (Register here)</a> --}}
                                <button class="btn btn-primary w-auto" id="loginForm_submit" type="submit">साइन इन करा </button>
                            </div>
                            {{-- <div class="form-group d-flex justify-content-between">
                                <a class="" href="{{ route('forget-password') }}">पासवर्ड विसरलात का ? (Forget Password ?)</a>
                            </div> --}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <!-- Theme js-->
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <!-- login js-->

    <script>
        $("#loginForm").submit(function(e) {
            e.preventDefault();
            $("#loginForm_submit").prop('disabled', true);
            var formdata = new FormData(this);
            $.ajax({
                url: '{{ route('field.signin') }}',
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (!data.error && !data.error2) {
                        // swal("Successful!", data.success, "success")
                            // .then((action) => {
                                    // window.location.href = '{{ route('dashboard') }}';
                                if( data.user_type == 'user' )
                                    window.location.href = "{{ route('field.home') }}";
                                else
                                    window.location.href = "{{ route('field.home') }}";
                            // });
                    } else {
                        if (data.error2) {
                            swal("Error!", data.error2, "error");
                            $("#loginForm_submit").prop('disabled', false);
                        } else {
                            $("#loginForm_submit").prop('disabled', false);
                            resetErrors();
                            printErrMsg(data.error);
                        }
                    }
                },
                error: function(error) {
                    $("#loginForm_submit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                },
            });

            function resetErrors() {
                var form = document.getElementById('loginForm');
                var data = new FormData(form);
                for (var [key, value] of data) {
                    console.log(key, value)
                    $('.' + key + '_err').text('');
                    $('#' + key).removeClass('is-invalid');
                    $('#' + key).addClass('is-valid');
                }
            }

            function printErrMsg(msg) {
                $.each(msg, function(key, value) {
                    console.log(key);
                    $('.' + key + '_err').text(value);
                    $('#' + key).addClass('is-invalid');
                });
            }

        });
    </script>

</body>

<script>

    showHidePassword1 = () => {
        var password = document.getElementById('password');
        var toggler = document.getElementById('password_eye');

        if (password.type == 'password') {
            password.setAttribute('type', 'text');

            toggler.querySelector('i').classList.remove('fa-eye-slash');
            toggler.querySelector('i').classList.add('fa-eye');
        }
        else
        {
            password.setAttribute('type', 'password');
            toggler.querySelector('i').classList.remove('fa-eye');
            toggler.querySelector('i').classList.add('fa-eye-slash');
        }
    };

</script>

</html>
