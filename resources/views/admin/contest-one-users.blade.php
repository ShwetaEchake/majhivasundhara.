<x-admin.admin-layout>
    <x-slot name="title">{{ auth()->user()->tenant_name }} - {{ Str::ucfirst($page_type) }} Forms</x-slot>

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">


                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{ Str::ucfirst($page_type) }} Forms</h3>
                    </div>
                    <div class="col-sm-6">
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
                            {{-- <div class="row">
                                <div class="col-sm-6">
                                    <div class="">
                                        <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
                                        <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="table-responsive">
                                <table class="display table-bordered" id="datatable-tabletools">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Competition</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Person Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Pincode</th>
                                            <th style="min-width: 100px">Total Marks</th>
                                            <th>Accessor Marks</th>
                                            <th>View Form</th>
                                            <th>Paryavaran Dut</th>
                                            <th>Paryavaran Excel</th>
                                            <th>Registered On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->competitionType->name }}</td>
                                                <td>{{ $user->category->name }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->nodal_person_name }}</td>
                                                <td>{{ $user->nodal_person_email }}</td>
                                                <td>{{ $user->nodal_person_contact }}</td>
                                                <td>{{ $user->pincode }}</td>
                                                @php
                                                    $finalPDMarks = $user->contestent_pd_count > $user->paryavaran_seva_marks ? $user->contestent_pd_count : $user->paryavaran_seva_marks;
                                                @endphp
                                                <td>{{ ($user->contests_sum_marks_obtained-$user->paryavaran_seva_marks) }} + {{ $finalPDMarks }} = {{ ($user->contests_sum_marks_obtained-$user->paryavaran_seva_marks)+$finalPDMarks }}</td>
                                                <td>
                                                    {{ $user->fieldEditedContestOne?->sum('marks')  }}
                                                </td>
                                                <td>
                                                    @if($user->is_submitted == 1)
                                                        <a target="_blank" href="{{ route('view_form', $user->id) }}" class="btn btn-primary">View Form</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($user->competition_type_id == 1)
                                                        <a target="_blank" href="{{ route('view_pd', $user->id) }}" class="btn btn-primary">View data</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($user->excel_path)
                                                        <a target="_blank" href="{{ asset('storage/'.$user->excel_path) }}" class="btn btn-primary">View Excel</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d M, y h:i:s') }}
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



    {{-- Change Password Form --}}
    <div class="modal fade" id="change-password-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" id="changePasswordForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" id="user_id" name="user_id" value="">

                        <div class="col-8 mx-auto my-2">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" id="new_password" name="new_password">
                                    {{-- <div class="show-hide"><span class="show"></span></div> --}}
                                </div>
                                <span class="text-danger error-text password_err"></span>
                            </div>
                        </div>

                        <div class="col-8 mx-auto my-2">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" id="confirmed_password" name="confirmed_password">
                                    {{-- <div class="show-hide"><span class="show"></span></div> --}}
                                </div>
                                <span class="text-danger error-text confirmed_password_err"></span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" id="changePasswordSubmit" type="submit">Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- Assign Role Modal --}}
    <div class="modal fade" id="assign-role-modal" role="dialog" >
        <div class="modal-dialog" role="document">
            <form action="" id="assignRoleForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Role</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" id="role_user_id" name="role_user_id" value="">

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" for="name">User Name : </label>
                            <div class="col-sm-9">
                                <h6 id="role_user_name" class="pt-2"></h6>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" for="name">Role : </label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" id="edit_role" name="edit_role">
                                    <option value="">--Select Role--</option>
                                </select>
                                <span class="text-danger error-text edit_role_err"></span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" id="assignRoleSubmit" type="submit">Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


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


<!-- Open Change Password Modal-->
<script>
    $("#datatable-tabletools").on("click", ".change-password", function(e) {
        e.preventDefault();
        var user_id = $(this).attr("data-id");
        $('#user_id').val(user_id);
        $('#change-password-modal').modal('show');
    });
</script>

<!-- Update User Password -->
<script>
    $("#changePasswordForm").submit(function(e) {
        e.preventDefault();
        $("#changePasswordSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        formdata.append('_method', 'PUT');
        var model_id = $('#user_id').val();
        var url = "{{ route('users.change-password', ':model_id') }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#changePasswordSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        $("#change-password-modal").modal('hide');
                        $("#changePasswordSubmit").prop('disabled', false);
                    });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#changePasswordSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#changePasswordSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

        function resetErrors() {
            var form = document.getElementById('changePasswordForm');
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
        var url = "{{ route('users.edit', ':model_id') }}";

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

                if (!data.error) {
                    $("#editForm input[name='edit_model_id']").val(data.user.id);
                    $("#editForm select[name='category_id']").html(data.categoryHtml);
                    $("#editForm select[name='competition_type_id']").html(data.competitionTypeHtml);
                    $("#editForm select[name='role']").html(data.roleHtml);
                    $("#editForm input[name='name']").val(data.user.name);
                    $("#editForm input[name='person_name']").val(data.user.person_name);
                    $("#editForm input[name='email']").val(data.user.email);
                    $("#editForm input[name='mobile']").val(data.user.mobile);
                    $("#editForm input[name='address']").val(data.user.address);
                    $("#editForm input[name='pincode']").val(data.user.pincode);
                    $("#editForm input[name='ward']").val(data.user.ward);
                    $("#editForm input[name='geo_location']").val(data.user.geo_location);
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
            var url = "{{ route('users.update', ':model_id') }}";
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
                            window.location.href = '{{ route('users.index') }}';
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

