<x-admin.admin-layout>
    <x-slot name="title">{{ auth()->user()->tenant_name }} - Questions</x-slot>

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">


                <!-- Add Form Start -->
                <div class="row" id="addContainer" style="display:none;">
                    <div class="col-sm-12">
                        <div class="card">
                            <form class="theme-form" name="addForm" id="addForm">
                                @csrf
                                <div class="card-header pb-0">
                                    <h4>Create Question</h4>
                                </div>
                                <div class="card-body pt-0">

                                    <div class="mb-3 row">

                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="competition_type_id">Select Competition Type <span class="text-danger">*</span></label>
                                            <select class="js-example-basic-single col-sm-12" id="competition_type_id" name="competition_type_id">
                                                <option value="">--Select Competition Type--</option>
                                                @foreach ($competitionTypes as $competitionType)
                                                    <option value="{{ $competitionType->id }}">{{ $competitionType->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-text competition_type_id_err"></span>
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="category_id">Select Category <span class="text-danger">*</span></label>
                                            <select class="js-example-basic-single col-sm-12" id="category_id" name="category_id">
                                                <option value="">--Select Category--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-text category_id_err"></span>
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="department_id">Select Department <span class="text-danger">*</span></label>
                                            <select class="js-example-basic-single col-sm-12" id="department_id" name="department_id">
                                                <option value="">--Select Department--</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-text department_id_err"></span>
                                        </div>
                                    </div>


                                    <div class="mb-3 row">
                                        <div class="col-12 mt-3" style="border-top: 1px solid #eee"></div>
                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="question">Question <span class="text-danger">*</span> </label>
                                            <input class="form-control" id="question" name="question" type="text" placeholder="Question">
                                            <span class="text-danger error-text question_err"></span>
                                        </div>
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="note">Note</label>
                                            <input class="form-control" name="note" type="text" placeholder="Note">
                                            <span class="text-danger error-text note_err"></span>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="link_type">Link Type</label>
                                            <select name="link_type" class="form-control">
                                                <option value="" selected>Select Link Type</option>
                                                <option value="0">Image</option>
                                                <option value="1">Video</option>
                                            </select>
                                            <span class="text-danger error-text link_type_err"></span>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="link">Image/Video Link</label>
                                            <input class="form-control" name="link" type="text" placeholder="Image/Video Link">
                                            <span class="text-danger error-text link_err"></span>
                                        </div>
                                    </div>


                                    <div class="mb-3 row">
                                        <div class="col-12 mt-3" style="border-top: 1px solid #eee"></div>
                                        <div class='element row' id='div_1'>

                                            <div class="col-md-4 mt-3">
                                                <label class="col-form-label" for="option">Option <span class="text-danger">*</span></label>
                                                <input class="form-control" name="option[]" type="text" placeholder="Option">
                                                <span class="text-danger error-text option_err"></span>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <label class="col-form-label" for="option_marks">Marks <span class="text-danger">*</span></label>
                                                <input class="form-control" name="option_marks[]" type="number" placeholder="Marks">
                                                <span class="text-danger error-text option_marks_err"></span>
                                            </div>
                                            <div class="col-md-4 mt-3 pt-3">
                                                <div class='add btn btn-info mt-3'><i class="fa fa-plus"></i> More</div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                {{-- Edit Form --}}
                <div class="row" id="editContainer" style="display:none;">
                    <div class="col">
                        <form class="form-horizontal form-bordered" method="post" id="editForm">
                            @csrf
                            <section class="card">
                                <header class="card-header">
                                    <h4 class="card-title">Edit Question</h4>
                                </header>

                                <div class="card-body py-2">
                                    <input type="hidden" id="edit_model_id" name="edit_model_id" value="">


                                    <div class="mb-3 row">

                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="competition_type_id">Select Competition Type <span class="text-danger">*</span></label>
                                            <select class="js-example-basic-single col-sm-12" id="competition_type_id" name="competition_type_id">
                                                <option value="">--Select Competition Type--</option>
                                            </select>
                                            <span class="text-danger error-text competition_type_id_err"></span>
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="category_id">Select Category <span class="text-danger">*</span></label>
                                            <select class="js-example-basic-single col-sm-12" id="category_id" name="category_id">
                                                <option value="">--Select Category--</option>
                                            </select>
                                            <span class="text-danger error-text category_id_err"></span>
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="department_id">Select Department <span class="text-danger">*</span></label>
                                            <select class="js-example-basic-single col-sm-12" id="department_id" name="department_id">
                                                <option value="">--Select Department--</option>
                                            </select>
                                            <span class="text-danger error-text department_id_err"></span>
                                        </div>
                                    </div>


                                    <div class="mb-3 row">
                                        <div class="col-12 mt-3" style="border-top: 1px solid #eee"></div>
                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="question">Question <span class="text-danger">*</span> </label>
                                            <input class="form-control" id="question" name="question" type="text" placeholder="Question">
                                            <span class="text-danger error-text question_err"></span>
                                        </div>
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="note">Note</label>
                                            <input class="form-control" name="note" type="text" placeholder="Note">
                                            <span class="text-danger error-text note_err"></span>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="link_type">Link Type</label>
                                            <select name="link_type" class="form-control">
                                                <option value="" selected>Select Link Type</option>
                                                <option value="0">Image</option>
                                                <option value="1">Video</option>
                                            </select>
                                            <span class="text-danger error-text link_type_err"></span>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <label class="col-form-label" for="link">Image/Video Link</label>
                                            <input class="form-control" name="link" type="text" placeholder="Image/Video Link">
                                            <span class="text-danger error-text link_err"></span>
                                        </div>
                                    </div>


                                    <div class="mb-3 row" id="edit_option">
                                        <div class="col-12 mt-3" style="border-top: 1px solid #eee"></div>
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
                        <h3>Questions</h3>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid support-ticket">
            <div class="row">

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="">
                                        <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
                                        <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="display table-bordered" id="datatable-tabletools">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Category</th>
                                            <th>Department</th>
                                            <th style="min-width: 150px">Question</th>
                                            <th style="min-width: 180px;">Option</th>
                                            <th style="min-width: 60px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($questions as $question)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $question->category?->name }}</td>
                                                <td>{{ $question->department?->name }}</td>
                                                <td>
                                                    {{ $question->name }} <br>
                                                    <strong>Marks:</strong> {{ $question->marks }}
                                                </td>
                                                <td>
                                                    @foreach ($question->options as $option)
                                                        {{$loop->iteration}}. {{ $option->name }} ({{$option->marks}}) <br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <button class="edit-element btn btn-primary px-2 py-1" title="Edit Question" data-id="{{ $question->id }}"><i data-feather="edit"></i></button>
                                                    <button class="btn btn-danger rem-element px-2 py-1" title="Remove Element" data-id="{{ $question->id }}"><i data-feather="trash"></i></button>
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
    </div>


</x-admin.admin-layout>


{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('questions.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('questions.index') }}';
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
        // $(".edit-element").show();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('questions.edit', ':model_id') }}";

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
                    $("#editForm input[name='edit_model_id']").val(data.question.id);
                    $("#editForm select[name='link_type']").val(data.question.link_type);
                    $("#editForm input[name='link']").val(data.question.link);
                    $("#editForm input[name='note']").val(data.question.note);
                    $("#editForm select[name='competition_type_id']").html(data.competitionTypeHtml);
                    $("#editForm select[name='category_id']").html(data.categoryHtml);
                    $("#editForm select[name='department_id']").html(data.departmentHtml);

                    $("#editForm input[name='question']").val(data.question.name);
                    $("#edit_option").html('');
                    $("#edit_option").append("<div class='element row' id='div_1'> <input type='hidden' name='option_id[]' > <div class='col-md-4 mt-3'> <label class='col-form-label' for='option'>Option <span class='text-danger'>*</span></label> <input class='form-control' name='option[]' type='text' placeholder='Option'> <span class='text-danger error-text option_err'></span> </div> <div class='col-md-4 mt-3'> <label class='col-form-label' for='option_marks'>Marks <span class='text-danger'>*</span></label> <input class='form-control' name='option_marks[]' type='number' placeholder='Marks'> <span class='text-danger error-text option_marks_err'></span> </div> <div class='col-md-4 mt-3 pt-3'> <div class='add btn btn-info mt-3'><i class='fa fa-plus'></i> More</div> </div> </div>");
                    $("#editForm input[name='option_id[]']").val(data.question.options[0].id);
                    $("#editForm input[name='option[]']").val(data.question.options[0].name);
                    $("#editForm input[name='option_marks[]']").val(data.question.options[0].marks);
                    var i;
                    for(i=1; i<=Object.keys(data.question.options).length; i++ )
                    {
                        $("#edit_option").append("<div class='element row' id='div_"+(i+1)+"'> <input type='hidden' name='option_id[]' value='"+data.question.options[i].id+"' > <div class='col-md-4 mt-3'> <label class='col-form-label' for='option'>Option <span class='text-danger'>*</span></label> <input class='form-control' name='option[]' type='text' placeholder='Option' value='"+data.question.options[i].name+"'> <span class='text-danger error-text option_err'></span> </div> <div class='col-md-4 mt-3'> <label class='col-form-label' for='option_marks'>Marks <span class='text-danger'>*</span></label> <input class='form-control' name='option_marks[]' type='number' placeholder='Marks' value='"+data.question.options[i].marks+"'> <span class='text-danger error-text option_marks_err'></span> </div> <div class='col-md-4 mt-3 pt-3'> <div id='remove_" + (i+1) + "' class='remove btn btn-info mt-3'>X</div> </div> </div>");
                    }
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
            var url = "{{ route('questions.update', ':model_id') }}";
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
                            window.location.href = '{{ route('questions.index') }}';
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



<!-- Delete -->
<script>
    $("#datatable-tabletools").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure to delete this question?",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('questions.destroy', ":model_id") }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'POST',
                    data: {
                        '_method': "DELETE",
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data, textStatus, jqXHR) {
                        if (!data.error && !data.error2) {
                            swal("Success!", data.success, "success")
                                .then((action) => {
                                    window.location.reload();
                                });
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
            }
        });
    });
</script>


{{-- Dynamic Form --}}
<script>
    $(document).ready(function(){

        $('#addContainer .card').on('click','.add',function(){

            var total_element = $("#addContainer .element").length;
            var lastid = $("#addContainer .element:last").attr("id");
            var split_id = lastid.split("_");
            var nextindex = Number(split_id[1]) + 1;

            var max = 7;
            if(total_element < max ){
                $("#addContainer .element:last").after("<div class='element row' id='div_"+ nextindex +"'></div>");
                $("#addContainer #div_" + nextindex).append("<div class='col-md-4 mt-3'>    <label class='col-form-label' for='option'>Option <span class='text-danger'>*</span></label>    <input class='form-control' name='option[]' type='text' placeholder='Option'>    <span class='text-danger error-text option_err'></span></div> <div class='col-md-4 mt-3'><label class='col-form-label' >Marks <span class='text-danger'>*</span></label>    <input class='form-control' name='option_marks[]' type='number' placeholder='Marks'>    <span class='text-danger error-text option_marks_err'></span></div> <div class='col-md-4 mt-3 pt-3'> <div id='remove_" + nextindex + "' class='remove btn btn-info mt-3'>X</div> </div>");
            }});

        // Remove element
        $('#addContainer .card').on('click','.remove',function(){

            var id = this.id;
            var split_id = id.split("_");
            var deleteindex = split_id[1];

            $("#addContainer #div_" + deleteindex).remove();
        });


        $('#editContainer .card').on('click','.add',function(){
            var total_element = $("#editContainer .element").length;
            var lastid = $("#editContainer .element:last").attr("id");
            var split_id = lastid.split("_");
            var nextindex = Number(split_id[1]) + 1;

            var max = 7;
            if(total_element < max ){
                $("#editContainer .element:last").after("<div class='element row' id='div_"+ nextindex +"'></div>");
                $("#editContainer #div_" + nextindex).append("<div class='col-md-4 mt-3'>    <label class='col-form-label' for='option'>Option <span class='text-danger'>*</span></label>    <input class='form-control' name='option[]' type='text' placeholder='Option'>    <span class='text-danger error-text option_err'></span></div> <div class='col-md-4 mt-3'><label class='col-form-label' >Marks <span class='text-danger'>*</span></label>    <input class='form-control' name='option_marks[]' type='number' placeholder='Marks'>    <span class='text-danger error-text option_marks_err'></span></div> <div class='col-md-4 mt-3 pt-3'> <div id='remove_" + nextindex + "' class='remove btn btn-info mt-3'>X</div> </div>");
            } });

            // Remove element
            $('#editContainer .card').on('click','.remove',function(){

            var id = this.id;
            var split_id = id.split("_");
            var deleteindex = split_id[1];

            $("#editContainer #div_" + deleteindex).remove();
        });
    });
</script>
