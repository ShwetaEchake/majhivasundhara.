<div>
    <div wire:loading.flex style="position: fixed;
        width: 100vw;
        height: 100vh;
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

    <div class="row pt-5 mb-5">
        <div class="col-12">

            <div class="row">

                <div class="col-12 col-lg-12 ml-auto mr-auto mb-5 mt-5">
                    <div class="multisteps-form__progress">
                        {{-- @if ($authUser->category_id != 2) --}}
                            <button class="js-active" style="background-color: #1dbe7254; border-radius: 8px; border: none;" wire:click="$set('show_pd', 1)">पर्यावरण दूत</button>
                        {{-- @endif --}}
                        @foreach ($questions as $question)
                            <button class="multisteps-form__progress-btn {{ $section >= $loop->iteration && $show_pd == 0 ? 'js-active' : '' }}" wire:click="changeSection({{$loop->iteration}})">{{ $question[0]->department?->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12 m-auto">

                        @foreach ($questions as $question)
                            <div class="multisteps-form__panel {{ $section == $loop->iteration && $show_pd == 0 ? 'js-active slideVert' : '' }}" data-animation="slideVert" >
                                <div class="inner">
                                    <div class="wizard-topper pt-4">
                                        <div class="wizard-progress">
                                            <span>{{ $loop->iteration }} of {{ $loop->count }} Completed</span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: {{ (($loop->iteration/$loop->count)*100) }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wizard-content-item text-center">
                                        <h2>{{ $question[0]->category?->name }} - {{ $question[0]->department?->name }}</h2>
                                    </div>

                                    <div class="wizard-content-form">
                                        <div class="container">
                                            @php
                                                $questionGroup = $question->groupBy('group_id');
                                            @endphp

                                            @foreach ($questionGroup as $question)

                                                <div class="question-group">
                                                    @foreach ($question as $key => $q)
                                                        <div class="row question-card mx-1">
                                                            <div class="col-12 question-top">
                                                                <div class="form-group mb-0">
                                                                    <div class="row">
                                                                        <div class="col-11">
                                                                            <h4 class="mb-2"> <strong>Q-{{ $key+1 }}) &nbsp;</strong> {{ $q->name }}</h4>
                                                                        </div>
                                                                        <div class="col-1 px-1">
                                                                            @if ($q->note)
                                                                                <span class="mx-1 float-right info-popup">
                                                                                    <i style="color: #1dbe72" class="fa fa-info"></i><span class="tooltiptext">{{$q->note}}</span>
                                                                                </span>
                                                                            @endif
                                                                            @if ($q->link)
                                                                                @if ($q->link_type == 1)
                                                                                    {{-- <span class="mx-1 float-right" style="background-color: #eee; padding: 3px 6px; border-radius: 100%;cursor: pointer;">
                                                                                        <a class="video-pop" video-url="{{ $q->link }}"> <i style="color: #1dbe72" class="fa fa-video"></i> </a>
                                                                                    </span> --}}
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
                                                                                    <input class="form-check-input" type="radio" name="qst_option.{{ $q->id }}" wire:model.defer="qst_option.{{ $q->id }}" id="qst_{{$q->id}}_opt_{{$option->id}}" data-mark="{{$option->marks}}" value="{{ $option->id }}">
                                                                                    <label style="font-weight: 500" class="form-check-label radio-label @if($errors->has('qst_option.'.$q->id)) is-invalid @endif"  for="qst_{{$q->id}}_opt_{{$option->id}}">{{ $option->name }}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                        <div class="col-12">
                                                                            @if ($errors->has('qst_option.'.$q->id))
                                                                                <span class="invalid-feedback d-block" role="alert">
                                                                                    <strong>{{ $errors->first('qst_option.'.$q->id) }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" wire:model.defer="hidden_qst_file_1.{{$q->id}}">
                                                            <input type="hidden" wire:model.defer="hidden_qst_file_2.{{$q->id}}">

                                                            <div class="col-12 question-bottom pb-0">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <div class="form-group mt-2">
                                                                            <input type="file" class="form-control mb-1 @if($errors->has('qst_file_1.'.$q->id)) is-invalid @endif" wire:model.defer="qst_file_1.{{ $q->id }}" id="qst_{{ $q->id }}_file_1" accept="image/png, image/gif, image/jpeg, application/pdf">
                                                                            <small class="form-text text-muted">Max 5MB file is required (Optional)</small>
                                                                            @if ($errors->has('qst_file_1.'.$q->id))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('qst_file_1.'.$q->id) }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1 col-sm-12">
                                                                        @if ( $hidden_qst_file_1 && array_key_exists($q->id, $hidden_qst_file_1) )
                                                                            <img src="{{ asset('storage/'.$hidden_qst_file_1[$q->id]) }}" alt="" class="img-fluid img-edit-preview">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-12">
                                                                        <div class="form-group mt-2">
                                                                            <input type="file" class="form-control mb-1 @if($errors->has('qst_file_2.'.$q->id)) is-invalid @endif" wire:model.defer="qst_file_2.{{ $q->id }}" id="qst_{{ $q->id }}_file_2" accept="image/png, image/gif, image/jpeg, application/pdf">
                                                                            <small class="form-text text-muted">Max 5MB file is required (Optional)</small>
                                                                            @if ($errors->has('qst_file_2.'.$q->id))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('qst_file_2.'.$q->id) }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1 col-sm-12">
                                                                        @if ( $hidden_qst_file_2 && array_key_exists($q->id, $hidden_qst_file_2) )
                                                                            <img src="{{ asset('storage/'.$hidden_qst_file_2[$q->id]) }}" alt="" class="img-fluid img-edit-preview">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-12 pt-2">
                                                                        <div class="form-group mb-0">
                                                                            <input type="text" class="form-control mb-0 @if($errors->has('qst_desc.'.$q->id)) is-invalid @endif" wire:model.defer="qst_desc.{{ $q->id }}" id="qst_desc_{{ $q->id }}" name="qst_desc.{{ $q->id }}" placeholder="Description" style="max-height: 40px; min-height: 40px" />
                                                                            @if ($errors->has('qst_desc.'.$q->id))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('qst_desc.'.$q->id) }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div wire:ignore class="col-md-1 col-sm-12 px-0 pt-3 {{ $q->competition_type_id == '2' ? 'marks-box' : '' }}">
                                                                        <strong>Marks : </strong>
                                                                        <span class="selected-marks">{{ $selected_marks && array_key_exists($q->id, $selected_marks) ? $selected_marks[$q->id] : '0' }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(!$loop->last)
                                                            <div class="row">
                                                                <div class="col-12 text-center">
                                                                    <h3 class="question-seperator">किंवा</h3>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="wizard-footer">
                                        <div class="container">
                                            <div class="row px-5">
                                                <div class="col-12 d-flex" style="overflow-x: auto">
                                                    <div class="actions ml-auto">
                                                        <ul>
                                                            @if ($loop->first)
                                                                <li><span class="js-btn-prev" wire:click="switchTabFun(1)" title="BACK" wire:loading.attr="disabled"><i class="fa fa-arrow-left"></i> BACK</span></li>
                                                            @endif
                                                            @if (!$loop->first)
                                                                <li><span class="js-btn-prev" wire:click="stepBack()" title="BACK"><i class="fa fa-arrow-left"></i> BACK</span></li>
                                                            @endif
                                                            @if ($loop->last)
                                                                <li><button type="submit" id="submit-form" wire:click.prevent="$emit('triggerSubmit', 'submit')" title="Submit">Final Submit </button></li>
                                                            @else
                                                                <li><span class="js-btn-next" wire:click="stepForward()" title="NEXT">NEXT <i class="fa fa-arrow-right"></i></span></li>
                                                            @endif

                                                            <li><button type="button" id="submit-form" wire:click.prevent="submitForm('draft')" title="Draft">Draft <i class="fa fa-envelope"></i></button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        {{-- @if ($authUser->category_id != 2) --}}
                            <div class="multisteps-form__panel {{ $show_pd ? 'js-active slideVert' : '' }}" data-animation="slideVert" >
                                <div class="inner">
                                    @livewire('paryavaran-dut-form')
                                </div>
                            </div>
                        {{-- @endif --}}

                </div>
            </div>


        </div>

    </div>
</div>

{{-- SWEETALERT EVENT FOR DELETE --}}
@push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {

            @this.on('triggerSubmit', command => {

                swal({
                    title: 'Are You Sure?',
                    text: 'एकदा सबमिट केल्यावर, तुम्ही स्पर्धा संपादित करू शकणार नाही!',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        @this.call('submitForm',command)
                        // window.location.href = '{{ route("marks") }}';
                    } else {
                        // swal("", {icon: "success",});
                    }
                });

            });
        })
    </script>
@endpush
