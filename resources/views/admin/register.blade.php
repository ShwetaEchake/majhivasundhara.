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
    <title>माझी वसुंधरा - Admin Panel Register</title>
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
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
</head>

<style>
    .text-danger.error-text{
        font-size: 11px;
    }
</style>

<body>
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>



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
                <div class="col-12">
                    <div class="login-card h-100">
                        <form class="theme-form login-form" style="width: 950px" id="loginForm">
                            <div class="col-12 mb-4 text-center">
                                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="" style="height: 100px; width: auto" class="img-fluid">
                                <h4 class="mt-3">ठाणे महानगरपालिका माझी वसुंधरा</h4>
                            </div>
                            @csrf

                            <h4>नोंदणी (Registration)</h4>
                            <h6>आपले खाते नोंदविण्यासाठी तपशील भरा (Fill details to register your account)</h6>

                            <div class="row">

                                <div class="col-sm-12 col-md-4">
                                    <label>स्पर्धेचा प्रकार निवडा <br> (Select Competition Type) <span class="text-danger">*</span></label>
                                    <select class="js-example-basic-single" name="competition_type_id">
                                        <option value="">-- स्पर्धेचा प्रकार निवडा (Select Competition Type)--</option>
                                        @foreach ($competitionTypes as $competitionType)
                                            <option value="{{ $competitionType->id }}">{{ $competitionType->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text competition_type_id_err"></span>
                                </div>
                                <div class="col-sm-12 col-md-4 d-none">
                                    <label>स्पर्धा मोड <br> (Select Competition Mode) <span class="text-danger">*</span></label>
                                    <select class="js-example-basic-single" name="competition_mode">
                                        <option value="">-- स्पर्धा मोड (Select Competition Mode)--</option>
                                        <option value="0">Individual (वैयक्तिक)</option>
                                        <option value="1">Institution (संस्था)</option>
                                    </select>
                                    <span class="text-danger error-text competition_mode_err"></span>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3 d-none">
                                    <label>सोसायटी/कार्यालय निवडा <br> (Select Society/Office) <span class="text-danger">*</span></label>
                                    <select class="js-example-basic-single" name="category_id" id="category_id">
                                        <option value="">--सोसायटी/कार्यालय निवडा (Select Society/Office)--</option>
                                        @foreach ($societies as $society)
                                            <option value="{{ $society->id }}">{{ $society->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text category_id_err"></span>
                                </div>

                                {{-- When User Selected option(1) then display this section --}}
                                <div class="col-sm-12 col-md-4 mb-3" style='display:none;' id='household_no'>
                                    <div class="form-group">
                                        <label> नागरिकांची संख्या <br> (No. of citizens) <span class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-home"></i></span>
                                            <input class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="text" name="household_no" id="household_no" placeholder="नागरिकांची संख्या (No. of citizens)">
                                        </div>
                                    </div>
                                </div>

                                {{-- When User Selected option(2) & option(3) then display both this section --}}
                                <div class="col-sm-12 col-md-4 mb-3" style='display:none;' id='tmc_total_students'>
                                    <div class="form-group">
                                        <label> विद्यार्थ्यांची संख्या <br> (Number of students) <span class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                            <input class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="text" name="tmc_total_students" id="tmc_total_students" placeholder="विद्यार्थ्यांची संख्या (Number of students)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3" style='display:none;' id='total_stud_in_private_school'>
                                    <div class="form-group">
                                        <label> विद्यार्थ्यांची संख्या <br> (Number of students) <span class="text-user">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                            <input class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="text" name="total_stud_in_private_school" id="total_stud_in_private_school" placeholder="विद्यार्थ्यांची संख्या (Number of students)">
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-sm-12 col-md-4 mb-3">
                                    <div class="form-group">
                                        <label>सोसायटी/कार्यालय नाव <br> (Society/Office Name) <span class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-home"></i></span>
                                            <input class="form-control" type="text" name="society_name" placeholder="सोसायटी/कार्यालय नाव (Society/Office Name)">
                                        </div>
                                        <span class="text-danger error-text society_name_err"></span>
                                    </div>
                                </div> --}}
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>सोसायटी/कार्यालय/इमारतीचे नाव <br> (Soc./Office/Build Name)<span class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-home"></i></span>
                                            <input class="form-control" type="text" name="building_name" placeholder="सोसायटी/कार्यालय/इमारतीचे नाव (Soc./Office/Build Name)">
                                        </div>
                                        <span class="text-danger error-text building_name_err"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <div class="form-group">
                                        <label>सोसायटी/कार्यालय दूरध्वनी <br> (Society/Office Telephone) <span class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-mobile"></i></span>
                                            <input class="form-control" type="number" name="society_telephone" placeholder="सोसायटी/कार्यालय दूरध्वनी (Society/Office Telephone)">
                                        </div>
                                        <span class="text-danger error-text society_telephone_err"></span>
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>जबाबदार व्यक्तीचे नाव <br> (Responsible Person Name) <span class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                            <input class="form-control" type="text" name="nodal_person_name" placeholder="जबाबदार व्यक्तीचे नाव (Responsible Person Name)">
                                        </div>
                                        <span class="text-danger error-text nodal_person_name_err"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>जबाबदार व्यक्ती संपर्क <br> (Responsible Person Contact) <span class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-mobile"></i></span>
                                            <input class="form-control" type="number" name="nodal_person_contact" placeholder="जबाबदार व्यक्ती संपर्क (Responsible Person Contact)">
                                        </div>
                                        <span class="text-danger error-text nodal_person_contact_err"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>जबाबदार व्यक्ती ईमेल <br> (Responsible Person Email) <span class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                            <input class="form-control" type="email" name="nodal_person_email" placeholder="जबाबदार व्यक्ती ईमेल (Responsible Person Email)">
                                        </div>
                                        <span class="text-danger error-text nodal_person_email_err"></span>
                                    </div>
                                </div>


                                {{-- <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>क्षेत्राचे नाव <br> (Area Name)<span class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-location-pin"></i></span>
                                            <input class="form-control" type="text" name="area_name" placeholder="क्षेत्राचे नाव (Area Name)">
                                        </div>
                                        <span class="text-danger error-text area_name_err"></span>
                                    </div>
                                </div> --}}
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>पत्ता तपशील <br> (Address Specification) <span class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-location-pin"></i></span>
                                            <input class="form-control" type="text" name="other_address" placeholder="पत्ता तपशील (Address Specification)">
                                        </div>
                                        <span class="text-danger error-text other_address_err"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>शहर <br> (City)<span class="text-danger">*</span></label>
                                        <select class="form-control" name="city">
                                            <option value="">--शहर निवडा (Select City)--</option>
                                            <option value="Thane">Thane</option>
                                        </select>
                                        <span class="text-danger error-text city_err"></span>
                                    </div>
                                </div>


                                {{-- <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>महत्त्वाची खूण <br> (Landmark)</label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-location-pin"></i></span>
                                            <input class="form-control" type="text" name="landmark" placeholder="महत्त्वाची खूण (Landmark)">
                                        </div>
                                        <span class="text-danger error-text landmark_err"></span>
                                    </div>
                                </div> --}}
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <label>प्रभाग <br> (Wards)<span class="text-danger">*</span></label>
                                    <select class="js-example-basic-single" name="ward_id">
                                        <option value="">--इतर पत्ता तपशील (Select Ward)--</option>
                                        @foreach ($wards as $ward)
                                            <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text ward_id_err"></span>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>पिन कोड <br> (Pincode)<span class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-location-pin"></i></span>
                                            <input class="form-control" type="number" name="pincode" placeholder="पिन कोड (Pincode)">
                                        </div>
                                        <span class="text-danger error-text pincode_err"></span>
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>वापरकर्ता नाव <br> (User Name) <span class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                                            <input class="form-control" type="text" name="username" placeholder="(User Name)">
                                        </div>
                                        <span class="text-danger error-text username_err"></span>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>पासवर्ड <br> (Password) <span class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                            <input class="form-control" type="password" id="password" name="password" placeholder="*********">
                                            <span class="input-group-text" id="password_eye" onclick="showHidePassword1()"><i class="eye fa fa-eye-slash"></i></span>
                                        </div>
                                        <span class="text-danger error-text password_err"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>पासवर्डची पुष्टी करा <br> (Confirm Password) <span class="text-danger">*</span></label>
                                        <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                            <input class="form-control" type="password" name="confirm_password" placeholder="*********">
                                        </div>
                                        <span class="text-danger error-text confirm_password_err"></span>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group d-flex justify-content-between">
                                <button class="btn btn-primary w-auto" id="loginForm_submit" type="submit">नोंदणी करा <br> (Register)</button>
                            </div>

                            <hr >
                            <div class="d-flex justify-content-right">
                                <b>अधिक माहितीसाठी संपर्क साधा : </b> <br>
                            </div>
                            <div class="justify-content-right">
                                <b>ईमेल : </b> support@coreocean.co.in <br>
                                <b>मोबाईल नं. :</b> 7304073989
                            </div>


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
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
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
                url: '{{ route('signup') }}',
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (!data.error && !data.error2) {
                        swal("यशस्वी!", 'नोंदणीसाठी धन्यवाद, स्पर्धा सुरू होण्यापूर्वी तुम्हाला एकदा सूचित केले जाईल.', "success")
                            .then((action) => {
                                    window.location.href = '{{ route('/') }}';
                            });
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
                    swal("त्रुटी आली!", "काहीतरी चूक झाली, कृपया पुन्हा प्रयत्न करा", "error");
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

<script>
    $(document).ready(function(){
        $('#category_id').on('change', function() {
        if ( this.value == '1')
        {
            $("#household_no").show();
        }
        else
        {
            $("#household_no").hide();
        }
        });

        $('select[name="competition_type_id"]').on('change', function() {
        if ( this.value === '2')
        {
            $("select[name='competition_mode']").closest('.col-sm-12').removeClass('d-none');
            $("select[name='category_id']").closest('.col-sm-12').addClass('d-none');
        }
        else
        {
            $("select[name='competition_mode']").closest('.col-sm-12').addClass('d-none');
            $("select[name='category_id']").closest('.col-sm-12').removeClass('d-none');
        }
        });

        $('select[name="competition_mode"]').on('change', function() {
        if ( this.value === '1')
            $("select[name='category_id']").closest('.col-sm-12').removeClass('d-none');
        else
            $("select[name='category_id']").closest('.col-sm-12').addClass('d-none');
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#category_id').on('change', function() {
        if ( this.value == '2')
        {
            $("#tmc_total_students").show();
        }
        else
        {
            $("#tmc_total_students").hide();
        }
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#category_id').on('change', function() {
        if ( this.value == '3')
        {
            $("#total_stud_in_private_school").show();
        }
        else
        {
            $("#total_stud_in_private_school").hide();
        }
        });
    });
</script>

</html>
