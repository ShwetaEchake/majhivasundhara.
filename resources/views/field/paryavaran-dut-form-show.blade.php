<x-admin.admin-layout>
    <x-slot name="title"> {{ $user->nodal_person_name }} - पर्यावरण दूत</x-slot>

    @push('styles')
        <style>
            .modal .card .preview-image {
                border-radius: 10px;
                border: 1px solid #e6edef;
                max-height: 90px;
                max-width: 100px;
            }
        </style>
    @endpush

    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid dashboard-default-sec">

            <div class="row">
                <div class="col-12 px-0">
                    <div class="card">
                        {{-- <div class="card-header p-2">
                            <h4>{{ ucfirst($user->nodal_person_name) }} - {{ ucfirst($user->category?->name) }}</h4>
                        </div> --}}

                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-12">
                                    {{-- @foreach ($user->ContestentPd as $contests) --}}
                                        <div class="card" style="font-size: 12px">
                                            <div class="card-header p-2">
                                                <h3 class="card-title mb-0"> पर्यावरण दूत</h3>
                                            </div>
                                            <div class="card-body p-2">
                                                <div class="row">
                                                    @foreach ($user->ContestentPd as $pd)
                                                        <div class="col-12 top-brdr mb-2">
                                                            <strong>Name:. </strong><span>{{ $pd->name }}</span> <br>
                                                            <strong>Age:. </strong><span>{{ $pd->age }}</span> <br>
                                                            <strong>Gender:. </strong><span>{{ $pd->gender }} </span> <br>
                                                            <strong>Activity:. </strong><span>{{ $pd->activity }}</span> <br>
                                                            <a href="{{ asset($pd->attached_file) }}" target="_blank">View File</a> <br>
                                                            <div class="row justify-content-end">
                                                                <div class="col-4 text-end">
                                                                    <a data-id="{{ $pd->id }}" data-editable="{{ $user->field_submitted_user_id ? false : true }}" data-userid="{{ $user->id }}" class="btn btn-primary btn-sm px-2 py-1 mb-1 editQuestion">{{ $user->field_submitted_user_id ? 'View' : 'Edit' }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    {{-- @endforeach --}}
                                </div>

                                {{-- <div class="col-12 text-end">
                                    <button data-userid="{{ $user->id }}"  {{ $user->field_submitted_user_id ? 'disabled' : '' }} class="btn btn-warning btn-sm px-2 py-1 final-submit">{{ $user->field_submitted_user_id ? 'Submitted' : 'Final Submit' }}</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- Container-fluid Ends-->
    </div>



    <!-- Modal -->
    <div class="modal fade" id="editPDModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="" id="editForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editPDFormTitle">Edit Question</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" {{ $user->field_submitted_user_id ? 'disabled' : '' }} name="user_contest_id" id="user_contest_id" value="">
                            <input type="hidden" {{ $user->field_submitted_user_id ? 'disabled' : '' }} name="contestant_user_id" id="contestant_user_id" value="">
                            <input type="hidden" {{ $user->field_submitted_user_id ? 'disabled' : '' }} name="latitude" id="latitude" value="">
                            <input type="hidden" {{ $user->field_submitted_user_id ? 'disabled' : '' }} name="longitude" id="longitude" value="">


                            <div class="col-12 mt-2">
                                <label class="col-form-label pb-0" for="name">Name<span class="text-danger">*</span> </label>
                                <input type="text" {{ $user->field_submitted_user_id ? 'disabled' : '' }}  name="name" id="name" class="form-control">
                                <span class="text-danger error-text name_err"></span>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="col-form-label pb-0" for="age">Age<span class="text-danger">*</span> </label>
                                <input type="text" {{ $user->field_submitted_user_id ? 'disabled' : '' }}  name="age" id="age" class="form-control">
                                <span class="text-danger error-text age_err"></span>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="col-form-label pb-0" for="gender">Gender<span class="text-danger">*</span> </label>
                                <select name="gender" id="gender" class="form-control" {{ $user->field_submitted_user_id ? 'disabled' : '' }}>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span class="text-danger error-text gender_err"></span>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="col-form-label pb-0" for="activity">Activity<span class="text-danger">*</span> </label>
                                <textarea name="activity" {{ $user->field_submitted_user_id ? 'disabled' : '' }} id="activity" cols="10" rows="5" class="form-control"></textarea>
                                <span class="text-danger error-text description_err"></span>
                            </div>


                            <div class="col-12 mt-2">
                                <div class="card" id="uploadedImage">
                                    <div id="image-preview" class="row px-2"></div>
                                </div>

                                <label class="col-form-label pb-0" for="file">File</label>
                                <input class="form-control" {{ $user->field_submitted_user_id ? 'disabled' : '' }} name="file" id="file" type="file" accept=".jpg, .jpeg, .png, .webp, .pdf">
                                <span class="text-danger error-text file_err"></span>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="editSubmit">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @push('scripts')
        <script>
            // const imageInput = document.getElementById('images');
            // const imagePreview = document.getElementById('image-preview');

            // imageInput.addEventListener('change', (event) => {
            //     if ($("#images")[0].files.length > 1) {
            //         swal("Error!", "You can upload upto 1 image only", "error");
            //         const file = document.querySelector('#images');
            //         file.value = '';
            //     }

            //     const files = event.target.files;
            //     imagePreview.innerHTML = '';
            //     for (let i = 0; i < files.length; i++) {
            //         const file = files[i];
            //         const reader = new FileReader();

            //         reader.addEventListener('load', (event) => {
            //             const image = document.createElement('img');
            //             image.src = event.target.result;
            //             image.classList.add('preview-image');

            //             const divSection = document.createElement('div');
            //             divSection.classList.add('col-4');
            //             divSection.classList.add('px-1');
            //             divSection.appendChild(image);

            //             imagePreview.appendChild(divSection);
            //         });

            //         reader.readAsDataURL(file);
            //     }
            // });

            // Open edit modal
            $(".editQuestion").click(function(e) {
                e.preventDefault();
                var model_id = $(this).attr("data-id");
                var user_id = $(this).attr("data-userid");
                var field_user_id = "{{ Auth::id() }}";
                var url = "{{ route('field.paryavaran_dut_form.edit', ':model_id') }}";


                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'GET',
                    data: {
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function(data, textStatus, jqXHR) {
                        console.log(data);
                        $('#user_contest_id').val(model_id);
                        $('#contestant_user_id').val(user_id);
                        if (!data.error) {
                            $("#editForm [name='name']").val(data.contestent_pd.name);
                            $("#editForm [name='age']").val(data.contestent_pd.age);
                            $("#editForm [name='gender']").val(data.contestent_pd.gender);
                            $("#editForm [name='activity']").val(data.contestent_pd.activity);
                            $("#image-preview").html(data.fileHtml);
                            // $("#image-preview").html(data.imgesHtml);
                            $('#editPDModal').modal('show');
                        } else {
                            swal("Error!", data.error, "error");
                        }
                    },
                    error: function(error, jqXHR, textStatus, errorThrown) {
                        swal("Error!", "Some thing went wrong", "error");
                    },
                });
            });
        </script>

        {{-- Get Lat Long --}}
        <script>
            const x = document.getElementById("lat_long");

            function getLocation() {
                if (navigator.geolocation)
                    navigator.geolocation.getCurrentPosition(showPosition);
                else
                    x.innerHTML = "Geolocation is not supported by this browser.";
            }

            function showPosition(position) {
                x.innerHTML = "Lat: " + position.coords.latitude + " &nbsp;&nbsp;&nbsp; Long: " + position.coords.longitude;
                $('#latitude').val(position.coords.latitude);
                $('#longitude').val(position.coords.longitude);
            }
        </script>

        <!-- Update edited form -->
        <script>
            $(document).ready(function() {
                $("#editForm").submit(function(e) {
                    e.preventDefault();

                    $("#editSubmit").prop('disabled', true);
                    var formdata = new FormData(this);
                    formdata.append('_method', 'PUT');
                    var model_id = $('#user_contest_id').val();
                    var url = "{{ route('field.paryavaran_dut_form.update', ':model_id') }}";
                    //
                    $.ajax({
                        url: url.replace(':model_id', model_id),
                        type: 'POST',
                        data: formdata,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $("#editSubmit").prop('disabled', false);
                            if (!data.error2)
                                swal("Successful!", data.success, "success")
                                .then((action) => {
                                    window.location.reload();
                                });
                            else
                                swal("Error!", data.error2, "error");
                        },
                        statusCode: {
                            422: function(responseObject, textStatus, jqXHR) {
                                $("#editSubmit").prop('disabled', false);
                                resetErrors();
                                printErrMsg(responseObject.responseJSON.errors);
                            },
                            500: function(responseObject, textStatus, errorThrown) {
                                $("#editSubmit").prop('disabled', false);
                                swal("Error occured!", "Something went wrong please try again", "error");
                            }
                        }
                    });

                    function resetErrors() {
                        var form = document.getElementById('editForm');
                        var data = new FormData(form);
                        for (var [key, value] of data) {
                            var field = key.replace('[]', '');
                            $('.' + field + '_err').text('');
                            $('#' + field).removeClass('is-invalid');
                            $('#' + field).addClass('is-valid');
                        }
                    }

                    function printErrMsg(msg) {
                        $.each(msg, function(key, value) {
                            var field = key.replace('[]', '');
                            $('.' + field + '_err').text(value);
                            $('#' + field).addClass('is-invalid');
                        });
                    }

                });
            });
        </script>

        {{-- Final Submit --}}
        <script>
            $(".final-submit").click(function(e) {
                e.preventDefault();
                var user_id = $(this).attr("data-userid");
                var url = "{{ route('field.paryavaran_form.final-submit', ':model_id') }}";

                $.ajax({
                    url: url.replace(':model_id', user_id),
                    type: 'GET',
                    data: {
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data, textStatus, jqXHR)
                    {
                        if(data.error2)
                        {
                            swal("Error!", data.error2, "error");
                        }
                        else
                        {
                            swal("Success", data.success, "success")
                            .then((action) => {
                                window.location.reload();
                            });
                        }
                    },
                    error: function(error, jqXHR, textStatus, errorThrown) {
                        swal("Error!", "Some thing went wrong", "error");
                    },
                });
            });
        </script>
    @endpush

</x-admin.admin-layout>
