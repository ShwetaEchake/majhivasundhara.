<div>
    <div wire:loading.flex style="position: fixed;
        width: 100%;
        height: 100%;
        justify-content: center;
        align-items: center;
        background: rgba(0,0,0,0.5);
        top: 0px;
        left: 0px;
        z-index: 4;
        pointer-events: none;
        font-size: 34px;
        font-weight: 600;
        color: #fff">Loading...
    </div>

    <div class="container">
        <div class="row px-md-3">
            <div class="col-sm-6 col-md-4 col-lg-4 mb-5 mt-5 px-md-5">
                <h2 class="js-active">पर्यावरण दूत</h2>
            </div>
            @if(!$is_submitted)
                <div class="col-sm-6 col-md-4 col-lg-4 mb-5 mt-5 px-md-4">
                    <a class="btn btn-info" target="_blank" href="{{ asset('sample_format.xlsx') }}"><i class="fa fa-download"></i> Download Sample</a>
                    <small class="form-text text-muted">sample file इथून डाउन्लोड करा</small>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 mb-5 mt-5 px-md-4">
                    <div class='file file--upload'>
                        <label for='input-file'>
                            <i class="fa fa-upload"></i> Upload
                        </label>
                        <input id='input-file' type='file' wire:model.defer="excel_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                    </div>
                    <small class="form-text text-muted mt-0">पर्यावरण दूत  हे 10 पेक्षा जास्ती असतील तर excel file उप्लोड करा</small>
                </div>
                {{-- <div class="col-sm-6 col-md-3 col-lg-3 mb-5 mt-5 px-md-5">
                    <button class="btn btn-primary" wire:click.prevent="add()"><i class="fa fa-plus"></i> Add More</button>
                </div> --}}
            @endif
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 m-auto">

                <div class="wizard-content-form">

                    @for ($i=1; $i <= $formCount; $i++ )
                        <div class="row question-card mx-1" wire:key="{{$i}}">
                            <div class="col-12 p-3">
                                <div class="row">
                                    <input type="hidden" wire:model.defer="hidden_id.{{$i}}" >
                                    <div class="col-4 mb-3">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" wire:model.defer="name.{{$i}}" name="name.{{$i}}" {{ $is_submitted ? 'readonly' : '' }} class="form-control mb-0 @if($errors->has('name.'.$i)) is-invalid @endif">
                                        @if ($errors->has('name.'.$i))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name.'.$i) }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="form-label">Age <span class="text-danger">*</span></label>
                                        <input type="number" wire:model.defer="age.{{$i}}" name="age.{{$i}}" {{ $is_submitted ? 'readonly' : '' }} class="form-control  mb-0 @if($errors->has('age.'.$i)) is-invalid @endif">
                                        @if ($errors->has('age.'.$i))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('age.'.$i) }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                                        <select wire:model.defer="gender.{{$i}}" name="gender.{{$i}}" class="form-control  mb-0 @if($errors->has('gender.'.$i)) is-invalid @endif" {{ $is_submitted ? 'disabled' : '' }} >
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        @if ($errors->has('gender.'.$i))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('gender.'.$i) }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="form-label">Activity <span class="text-danger">*</span></label>
                                        <input type="text" wire:model.defer="activity.{{$i}}" name="activity.{{$i}}" {{ $is_submitted ? 'readonly' : '' }} class="form-control  mb-0 @if($errors->has('activity.'.$i)) is-invalid @endif">
                                        @if ($errors->has('activity.'.$i))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('activity.'.$i) }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-4 mb-3">
                                        <input type="hidden" wire:model.defer="hidden_image.{{$i}}">
                                        <label class="form-label">File Upload <span class="text-danger">*</span></label>
                                        <input class="form-control file-input mb-0 @if($errors->has('image.'.$i)) is-invalid @endif" name="image.{{$i}}" {{ $is_submitted ? 'disabled' : '' }} type="file" wire:model.defer="image.{{$i}}" accept=".jpeg,.jpg,.png,.gif,.pdf">
                                        @if ($errors->has('image.'.$i))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image.'.$i) }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-3 mb-3">
                                        @if ( $hidden_image && array_key_exists($i, $hidden_image) )
                                            @php
                                                $file = explode('/', $hidden_image[$i]);
                                                $isPdf = substr($file[3], -3, 3) == 'pdf' ? true : false;
                                            @endphp

                                            @if($isPdf)
                                                <a class="btn btn-info mt-4" href="{{asset($hidden_image[$i])}}" target="_blank">View Pdf</a>
                                            @else
                                                <img src="{{asset($hidden_image[$i])}}" alt="" class="img-fluid" style="max-width: 150px; max-height: 100px; border-radius: 8px">
                                            @endif
                                        @endif
                                    </div>
                                    @if(!$is_submitted)
                                        <div class="col-1 align-self-end  mb-3">
                                            @if($hidden_id)
                                                <button class="btn btn-primary float-right" wire:click.prevent="remove({{ array_key_exists($i, $hidden_id) ? $hidden_id[$i] : 0 }})"> <i class="fa fa-trash"></i> </button>
                                            @else
                                                <button class="btn btn-primary float-right" wire:click.prevent="remove(0)"> <i class="fa fa-trash"></i> </button>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endfor

                </div>
                <div class="wizard-footer">
                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="actions ml-auto">
                                <ul>
                                    @if(!$is_submitted)
                                        <li><button type="button" class="btn-primary text-white" id="submit-form" wire:click.prevent="submitForm()" wire:loading.attr="disabled" title="Save">Save </button></li>
                                        <li><button type="button" class="btn-primary text-white" wire:click.prevent="nextTab()" wire:loading.attr="disabled" title="Next">Next </button></li>
                                        <li><button class="btn-dark" wire:click.prevent="add()"><i class="fa fa-plus" style="right: 0 !important"></i> Add More</button></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
