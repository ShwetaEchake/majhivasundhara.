<x-admin.admin-layout>
    <x-slot name="title">{{ auth()->user()->tenant_name }} - Paryavaran Dut Filled Form</x-slot>

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
        <div class="container-fluid">
            <div class="page-header">



                {{-- Edit Form --}}
                <div class="row" id="editContainer" style="display:none;">
                    <div class="col">
                        <form class="form-horizontal form-bordered" method="post" id="editForm">
                            @csrf
                            <section class="card">
                                <header class="card-header">
                                    <h4 class="card-title">Edit Paryavaran Dut Filled Form</h4>
                                </header>

                                <div class="card-body py-2">

                                    <input type="hidden" id="edit_model_id" name="edit_model_id" value="">

                                    <div class="mb-3 row">

                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label" for="question_id">Question <span class="text-danger">*</span></label>
                                            <input class="form-control" name="question_id" disabled type="text" placeholder="Enter Question">
                                            <span class="text-danger error-text question_id_err"></span>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label" for="option_id">Select Option <span class="text-danger">*</span></label>
                                            <select class="js-example-basic-single col-sm-12" name="option_id">
                                                <option value="">--Select Option--</option>
                                            </select>
                                            <span class="text-danger error-text option_id_err"></span>
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="document_1">Document 1 <span class="text-danger">*</span></label>
                                            <input class="form-control" name="document_1" type="file" placeholder="Select File">
                                            <span class="text-danger error-text document_1_err" style="font-size: 12px">Choose if want to replace existing uploaded file</span>
                                        </div>
                                        <div class="col-md-2 mt-3">
                                            <div id="doc_1"></div>
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="document_2">Document 2 </label>
                                            <input class="form-control" name="document_2" type="file" placeholder="Select File">
                                            <span class="text-danger error-text document_2_err"></span>
                                        </div>
                                        <div class="col-md-2 mt-3">
                                            <div id="doc_2"></div>
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="description">Description <span class="text-danger">*</span></label>
                                            <textarea name="description" cols="10" rows="5" class="form-control"></textarea>
                                            <span class="text-danger error-text description_err"></span>
                                        </div>

                                        <div class="col-md-4 mt-3 align-self-start">
                                            <label class="col-form-label" for="marks_obtained">Marks Obtained <span class="text-danger">*</span></label>
                                            <input class="form-control" name="marks_obtained" type="number" placeholder="Enter Marks">
                                            <span class="text-danger error-text marks_obtained_err"></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" id="editSubmit">Update</button>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{ ucfirst($user->name) }} Paryavaran Dut Filled Form</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid support-ticket">
            <div class="row">

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="">
                                        {{-- <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button> --}}
                                        <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="display table-bordered" id="datatable-tabletools">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Department</th>
                                            <th>Question</th>
                                            <th>Selected Answer</th>
                                            <th>Document 1</th>
                                            <th>Document 2</th>
                                            <th>Description</th>
                                            <th>Marks Obtained</th>
                                            <th>Field Action</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($answers as $answer)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $answer->department?->name }}</td>
                                                <td>{{ $answer->selectedQuestion?->name }}</td>
                                                <td>{{ $answer->selectedOption?->name }}</td>
                                                <td>
                                                    @if($answer->document_1)
                                                        <a href="{{ asset('storage/'.$answer->document_1) }}" target="_blank" >View File</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($answer->document_2)
                                                        <a href="{{ asset('storage/'.$answer->document_2) }}" target="_blank" >View File</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span data-meta="{{ $answer->description }}">
                                                        {!! Str::limit($answer->description, 90, ' &nbsp;<a href="#" class="view-more">view more</a>') !!} &nbsp;
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $answer->marks_obtained }}
                                                </td>
                                                <td>
                                                    @if($answer->fieldEditedForm)
                                                        <button class="btn btn-dark btn-sm px-2 py-1 d-flex align-items-center editQuestion" title="view field accessor response" data-userid="{{ $answer->user_id }}" data-id="{{ $answer->id }}"><i data-feather="eye"></i> <span class="ms-2">view</span></button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="edit-element btn btn-primary px-2 py-1" title="Edit Answer" data-id="{{ $answer->id }}"><i data-feather="edit"></i></button>
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
        </div>
        <!-- Container-fluid Ends-->
    </div>

    <!-- View More Modal -->
    <div class="modal fade" id="viewMoreModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editJJFormTitle">Edit Question</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-12 mt-2">

                            <div class="card">
                                <p id="viewMoreDetail" class="px-2"></p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editJJModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="" id="editModalForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editJJFormTitle">Edit Question</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="user_contest_id" id="user_contest_id" value="">
                            <input type="hidden" name="contetant_user_id" id="contetant_user_id" value="">
                            <input type="hidden" name="latitude" id="latitude" value="">
                            <input type="hidden" name="longitude" id="longitude" value="">

                            <div class="col-12 mt-2">

                                <div class="card" id="uploadedImage">
                                    <div id="image-preview" class="row px-2"></div>
                                </div>

                            </div>

                            <div class="col-12 mt-2">
                                <label class="col-form-label pb-0" for="description">Description<span class="text-danger">*</span> </label>
                                <textarea name="description" disabled id="description" cols="10" rows="5" class="form-control"></textarea>
                                <span class="text-danger error-text description_err"></span>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="col-form-label pb-0" for="marks">Marks<span class="text-danger">*</span> </label>
                                <input type="number" max="50" min="0" required name="marks" id="marks" class="form-control">
                                <span class="text-danger error-text marks_err"></span>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="col-form-label pb-0" id="lat_long">Lat: 0 &nbsp;&nbsp;&nbsp; Long: 0</label> <br>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="editModalSubmit">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @push('scripts')
        <script>
            // Open edit modal
            $(".editQuestion").click(function(e) {
                e.preventDefault();
                var model_id = $(this).attr("data-id");
                var url = "{{ route('field.paryavaran_form.edit', ':model_id') }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'GET',
                    data: {
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data, textStatus, jqXHR) {
                        $('#user_contest_id').val(model_id);
                        $('#contetant_user_id').val($(this).attr("data-userid"));
                        if (!data.error) {
                            $("#editModalForm [name='description']").text(data.contest.description);
                            $("#editModalForm [name='marks']").val(data.contest.marks_obtained);
                            $("#image-preview").html(data.imgesHtml);
                            const x = document.getElementById("lat_long");
                            x.innerHTML = "Lat: " + data.fieldEditedForm.latitude + " &nbsp;&nbsp;&nbsp; Long: " + data.fieldEditedForm.longitude;
                            $('#editJJModal').modal('show');
                        } else {
                            swal("Error!", data.error, "error");
                        }
                    },
                    error: function(error, jqXHR, textStatus, errorThrown) {
                        swal("Error!", "Some thing went wrong", "error");
                    },
                });
            });


            $(document).ready(function() {
                $("#editModalForm").submit(function(e) {
                    e.preventDefault();

                    $("#editModalSubmit").prop('disabled', true);
                    var formdata = new FormData(this);
                    formdata.append('_method', 'PUT');
                    var model_id = $('#user_contest_id').val();
                    var url = "{{ route('paryavaran_field_marks.update', ':model_id') }}";
                    //
                    $.ajax({
                        url: url.replace(':model_id', model_id),
                        type: 'POST',
                        data: formdata,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $("#editModalSubmit").prop('disabled', false);
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
                                $("#editModalSubmit").prop('disabled', false);
                                resetErrors();
                                printErrMsg(responseObject.responseJSON.errors);
                            },
                            500: function(responseObject, textStatus, errorThrown) {
                                $("#editModalSubmit").prop('disabled', false);
                                swal("Error occured!", "Something went wrong please try again", "error");
                            }
                        }
                    });

                    function resetErrors() {
                        var form = document.getElementById('editModalForm');
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

        {{-- View more button --}}
        <script>
            $('.view-more').click(function(e){
                e.preventDefault();

                const detailText = $(this).closest('span').attr('data-meta');
                $('#viewMoreDetail').text(detailText);
                $('#viewMoreModal').modal('show');
            });
        </script>

    @endpush


</x-admin.admin-layout>


<!-- Toggle Status -->
<script>
    $("#datatable-tabletools").on("change", ".status", function(e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('users.toggle', ':model_id') }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {
                if (!data.error && !data.error2) {
                    swal("Success!", data.success, "success");
                } else {
                    if (data.error) {
                        swal("Error!", data.error, "error");
                    } else {
                        swal("Error!", data.error2, "error");
                    }
                }
            },
            error: function(error, jqXHR, textStatus, errorThrown) {
                swal("Error!", "Something went wrong", "error");
            },
        });
    });
</script>


{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('users.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('users.index') }}';
                    });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#addSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#addSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

        function resetErrors() {
            var form = document.getElementById('addForm');
            var data = new FormData(form);
            for (var [key, value] of data) {
                $('.' + key + '_err').text('');
                $('#' + key).removeClass('is-invalid');
                $('#' + key).addClass('is-valid');
            }
        }

        function printErrMsg(msg) {
            $.each(msg, function(key, value) {
                $('.' + key + '_err').text(value);
                $('#' + key).addClass('is-invalid');
                $('#' + key).removeClass('is-valid');
            });
        }

    });
</script>



<!-- Edit -->
<script>
    $("#datatable-tabletools").on("click", ".edit-element", function(e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('user-form.edit', ':model_id') }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {
                $("#addContainer").slideUp();
                $("#btnCancel").show();
                $("#addToTable").hide();
                $("#editContainer").slideDown();
                $("html, body").animate({ scrollTop: 0 }, "slow");

                if (data.result === 1) {
                    console.log(data);
                    $("#editForm input[name='edit_model_id']").val(data.user_contest.id);
                    $("#editForm input[name='question_id']").val(data.user_contest.selected_question.name);
                    $("#editForm select[name='option_id']").html(data.optionHtml);
                    $("#doc_1").html(data.doc1Html);
                    $("#doc_2").html(data.doc2Html);
                    $("#editForm textarea[name='description']").val(data.user_contest.description);
                    $("#editForm input[name='marks_obtained']").val(data.user_contest.marks_obtained);
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


<!-- Update -->
<script>
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            formdata.append('_method', 'PUT');
            var model_id = $('#edit_model_id').val();
            var url = "{{ route('user-form.update', ':model_id') }}";
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


<!-- Open Assign Role Modal-->
<script>
    $("#datatable-tabletools").on("click", ".assign-role", function(e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('users.get-role', ':model_id') }}";
        $('#role_user_id').val(model_id);

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {

                if (!data.error) {
                    $("#editForm input[name='edit_model_id']").val(data.user.id);
                    $("#edit_role").html(data.roleHtml);
                    $("#role_user_name").text(data.user.name);
                } else {
                    swal("Error!", data.error, "error");
                }
            },
            error: function(error, jqXHR, textStatus, errorThrown) {
                swal("Error!", "Some thing went wrong", "error");
            },
        });

        $('#assign-role-modal').modal('show');
    });
</script>

<!-- Update User Role -->
<script>
    $("#assignRoleForm").submit(function(e) {
        e.preventDefault();
        $("#assignRoleSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        formdata.append('_method', 'PUT');
        var model_id = $('#role_user_id').val();
        var url = "{{ route('users.assign-role', ':model_id') }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#assignRoleSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        $("#assign-role-modal").modal('hide');
                    });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#assignRoleSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#assignRoleSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

        function resetErrors() {
            var form = document.getElementById('assignRoleForm');
            var data = new FormData(form);
            for (var [key, value] of data) {
                $('.' + key + '_err').text('');
                $('#' + key).removeClass('is-invalid');
                $('#' + key).addClass('is-valid');
            }
        }

        function printErrMsg(msg) {
            $.each(msg, function(key, value) {
                $('.' + key + '_err').text(value);
                $('#' + key).addClass('is-invalid');
                $('#' + key).removeClass('is-valid');
            });
        }

    });
</script>

