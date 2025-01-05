<x-frontend.layout>
    <x-slot name="title">माझी वसुंधरा | Contest Form</x-slot>

    @push('styles')
        <link rel="stylesheet" href="{{ public_path('frontend/form/style.css') }}">
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

    @php
        $authUser = auth()->user()
    @endphp
    <div class="question-top-bg-img">
        <img src="{{ public_path('frontend/images/grass_top.png') }}" class="img-fluid" alt="">
    </div>

        <div class="container-fluid px-md-5">





            <div class="row pt-5 mb-5">
                <div class="col-12">

                    <div class="row">
                        <button class="btn btn-info btn-sm" id="printBtn" style="position: absolute; right: 0; z-index: 99" onclick="window.print()"> <i class="fa fa-print"></i> Print</button>

                        <div class="col-12 col-lg-12 m-auto" id="printable-area">

                                @foreach ($questions as $question)
                                    <div class="multisteps-form__panel js-active slideVert" data-animation="slideVert" >
                                        <div class="inner">

                                            <div class="wizard-content-item text-center">
                                                <h2>{{ $question[0]->category?->name }} - {{ $question[0]->department?->name }}</h2>
                                            </div>

                                            <div class="wizard-content-form">

                                                @foreach ($question as $key=> $q)
                                                    <div class="row question-card mx-5">
                                                        <div class="col-12 question-top">
                                                            <div class="form-group mb-0">
                                                                <div class="row">
                                                                    <div class="col-11">
                                                                        <h4 class="mb-2"> <strong>Q-{{ $key+1 }}) &nbsp;</strong> {{ $q->name }}</h4>
                                                                    </div>
                                                                    <div class="col-1 pl-0">
                                                                        @if ($q->note)
                                                                            <span class="mx-1 float-right info-popup">
                                                                                <i style="color: #1dbe72" class="fa fa-info"></i><span class="tooltiptext">{{$q->note}}</span>
                                                                            </span>
                                                                        @endif
                                                                        @if ($q->link)
                                                                            @if ($q->link_type == 1)
                                                                                <span class="mx-1 float-right" style="background-color: #eee; padding: 3px 6px; border-radius: 100%;cursor: pointer;">
                                                                                    <a href="{{ $q->link }}" target="_blank"> <i style="color: #1dbe72" class="fa fa-video"></i> </a>
                                                                                </span>
                                                                            @else
                                                                                <span class="mx-1 float-right" style="background-color: #eee; padding: 3px 6px; border-radius: 100%;cursor: pointer;">
                                                                                    <ul class="imageGallery">
                                                                                        <li>
                                                                                            <a style="cursor: pointer"><img src="{{ $q->link }}" class="img-fluid d-none" > <i style="color: #1dbe72" class="fa fa-image"></i> </a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </span>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    @foreach ($q->options as $option)
                                                                        <div class="col-3">
                                                                            <div class="form-check radio">
                                                                                <input class="form-check-input" {{ $option->id == $q->userSelectedOption->option_id ? 'checked' : '' }} type="radio" name="qst_option.{{ $q->id }}"  value="{{ $option->id }}" readonly>
                                                                                <label style="font-weight: 500" class="form-check-label radio-label" >{{ $option->name }}</label>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-12 question-bottom pb-0">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <div class="form-group m-0 mb-2">
                                                                        @php
                                                                            $fileNameParts = explode('.', $q->userSelectedOption->document_1);
                                                                            $ext = end($fileNameParts);
                                                                        @endphp
                                                                        @if ($ext == 'pdf')
                                                                            <a class="btn btn-primary" target="_blank" href="{{ public_path('storage/'.$q->userSelectedOption->document_1) }}">View File</a>
                                                                        @else
                                                                            <img src="{{ public_path('storage/'.$q->userSelectedOption->document_1) }}" class="img-fluid" style="max-width: 140px; max-height:140px;border-radius: 8px;border: 1px solid #eee;" alt="">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-group m-0 mb-2">
                                                                        @php
                                                                            $fileNameParts = explode('.', $q->userSelectedOption->document_2);
                                                                            $ext = end($fileNameParts);
                                                                        @endphp
                                                                        @if ($ext == 'pdf')
                                                                            <a class="btn btn-primary" target="_blank" href="{{ public_path('storage/'.$q->userSelectedOption->document_2) }}">View File</a>
                                                                        @else
                                                                            <img src="{{ public_path('storage/'.$q->userSelectedOption->document_2) }}" class="img-fluid" style="max-width: 140px; max-height:140px;border-radius: 8px;border: 1px solid #eee;" alt="">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-group m-0 mb-2">
                                                                        <textarea class="form-control m-0" rows="5" readonly placeholder="Description" style="max-height: 65px; min-height: 65px">{{ $q->userSelectedOption->description }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-1 pt-3 {{ $q->competition_type_id == '2' ? 'marks-box' : '' }}">
                                                                    <strong>Marks : </strong>
                                                                    <span class="selected-marks">{{ $selected_marks && array_key_exists($q->id, $selected_marks) ? $selected_marks[$q->id] : '0' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                                <div class="multisteps-form__panel js-active slideVert" data-animation="slideVert" >
                                    <div class="inner">


                                        <div class="container">
                                            <div class="row px-md-3">
                                                <div class="col-sm-6 col-md-3 col-lg-3 mb-5 mt-5 px-md-5">
                                                    <h2 class="js-active">पर्यावरण दूत</h2>
                                                </div>
                                                @if(!$is_submitted)
                                                    <div class="col-sm-6 col-md-3 col-lg-3 mb-5 mt-5 px-md-5">
                                                        <a class="btn btn-info" target="_blank" href="{{ public_path('sample_format.xlsx') }}"><i class="fa fa-download"></i> Download Sample</a>
                                                    </div>
                                                    <div class="col-sm-6 col-md-3 col-lg-3 mb-5 mt-5 px-md-5">
                                                        <div class='file file--upload'>
                                                            <label for='input-file'>
                                                                <i class="fa fa-upload"></i> Upload
                                                            </label>
                                                            <input id='input-file' type='file' wire:model.defer="excel_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-3 col-lg-3 mb-5 mt-5 px-md-5">
                                                        <button class="btn btn-primary" wire:click.prevent="add()"><i class="fa fa-plus"></i> Add More</button>
                                                    </div>
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
                                                                            <label class="form-label">Image <span class="text-danger">*</span></label>
                                                                            <input class="form-control file-input mb-0 @if($errors->has('image.'.$i)) is-invalid @endif" name="image.{{$i}}" {{ $is_submitted ? 'disabled' : '' }} type="file" wire:model.defer="image.{{$i}}" accept=".jpeg,.jpg,.png,.gif">
                                                                            @if ($errors->has('image.'.$i))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('image.'.$i) }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-3 mb-3">
                                                                            @if ( $hidden_image && array_key_exists($i, $hidden_image) )
                                                                                <img src="{{public_path($hidden_image[$i])}}" alt="" class="img-fluid" style="max-width: 150px; max-height: 100px; border-radius: 8px">
                                                                            @endif
                                                                        </div>
                                                                        @if(!$is_submitted)
                                                                            <div class="col-1 align-self-end  mb-3">
                                                                                <button class="btn btn-primary float-right" wire:click.prevent="remove()"> <i class="fa fa-trash"></i> </button>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endfor

                                                    </div>
                                                    <div class="wizard-footer">
                                                        <div class="row px-5">
                                                            <div class="col-12 d-flex">
                                                                <div class="actions ml-auto">
                                                                    <ul>
                                                                        @if(!$is_submitted)
                                                                            <li><button type="button" class="btn-primary text-white" id="submit-form" wire:click.prevent="submitForm()" wire:loading.attr="disabled" title="Save">Save </button></li>
                                                                        @endif
                                                                            <li><button type="button" class="btn-primary text-white" wire:click.prevent="nextTab()" wire:loading.attr="disabled" title="Next">Next </button></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                        </div>
                    </div>

                </div>
            </div>








        </div>

    <div class="question-bottom-bg-img">
        <img src="{{ public_path('frontend/images/grass_bottom.png') }}" class="img-fluid" alt="">
    </div>

    @push('scripts')
        <script src="{{ public_path('frontend/form/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ public_path('frontend/form/popper.min.js') }}"></script>
        <script src="{{ public_path('frontend/form/bootstrap.min.js') }}"></script>
        <script src="{{ public_path('frontend/form/switch.js') }}"></script>
        <script src="{{ public_path('frontend/form/main.js') }}"></script>

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

</x-frontend.layout>
