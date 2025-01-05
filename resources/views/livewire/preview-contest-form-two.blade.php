<div class="row pt-5 mb-5">
    <div class="col-12">

        {{-- <div class="row">


            <div class="col-12 col-lg-12 ml-auto mr-auto mb-5 mt-5">
                <div class="multisteps-form__progress">
                    @foreach ($questions as $question)
                        <button class="multisteps-form__progress-btn {{ $section >= $question[0]->department_id ? 'js-active' : '' }}">{{ $question[0]->department?->name }}</button>
                    @endforeach
                </div>
            </div>
        </div> --}}
        <div class="row">
            <button class="btn btn-info btn-sm" id="printBtn" style="position: absolute; right: 0; z-index: 99" onclick="window.print()"> <i class="fa fa-print"></i> Print</button>

            <div class="col-12 col-lg-12 m-auto" id="printable-area">

                    @foreach ($questions as $question)
                        <div class="multisteps-form__panel js-active slideVert" data-animation="slideVert" >
                            <div class="inner">
                                {{-- <div class="wizard-topper pt-4">
                                    <div class="wizard-progress">
                                        <span>{{ ($question[0]->department_id-5) }} of {{ $loop->count }} Completed</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: {{ ((($question[0]->department_id-5)/$loop->count)*100) }}%"></div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="wizard-content-item text-center">
                                    <h2> {{ $question[0]->department?->name }}</h2>
                                </div>

                                <div class="wizard-content-form">
                                    @foreach ($question as $key=> $q)
                                        <div class="row question-card mx-5">
                                            <div class="col-12 question-two-top">
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
                                                            <div class="col-3 mt-3">
                                                                <div class="form-group">
                                                                    <label style="font-weight: 500" class="form-label" >Description</label>
                                                                    <input class="form-control @if($errors->has('description.'.$q->id)) is-invalid @endif" readonly type="text" name="description.{{$q->id}}" wire:model.defer="description.{{$q->id}}" >
                                                                    @if ($errors->has('description.'.$q->id))
                                                                        <span class="invalid-feedback d-block" role="alert">
                                                                            <strong>{{ $errors->first('description.'.$q->id) }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-2 d-flex align-self-center">
                                                                @if ( $picture && array_key_exists($q->id, $picture) )
                                                                    <a href="{{ asset('storage/'.$picture[$q->id]) }}" target="_blank">
                                                                        <img src="{{ asset('storage/'.$picture[$q->id]) }}" alt="" class="img-fluid img-edit-preview">
                                                                    </a>
                                                                @endif
                                                            </div>
                                                            <div class="col-2 d-flex align-self-center">
                                                                @if ( $video && array_key_exists($q->id, $video) && $video[$q->id] )
                                                                    <a href="{{ asset('storage/'.$video[$q->id]) }}" target="_blank" alt="">View Video</a>
                                                                @endif
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                                {{-- <div class="wizard-footer">
                                    <div class="row px-5">
                                        <div class="col-12 d-flex">
                                            <div class="actions ml-auto">
                                                <ul>
                                                    @if (!$loop->first)
                                                        <li><span class="js-btn-prev" wire:click="stepBack()" title="BACK"><i class="fa fa-arrow-left"></i> BACK</span></li>
                                                    @endif
                                                    @if ($loop->last)
                                                        <li><button type="submit" id="submit-form" wire:click.prevent="submitForm('submit')" title="Submit">Final Submit </button></li>
                                                    @else
                                                        <li><span class="js-btn-next" wire:click="stepForward()" title="NEXT">NEXT <i class="fa fa-arrow-right"></i></span></li>
                                                    @endif

                                                    <li><button type="button" id="submit-form" wire:click.prevent="submitForm('draft')" title="Draft">Draft <i class="fa fa-envelope"></i></button></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                    @endforeach

            </div>
        </div>


    </div>

</div>

@push('scripts')
    <script type="text/javascript">
        window.onbeforeprint = function(){
            $('#printBtn').addClass('d-none');
        }
        window.onafterprint = function(){
            $('#printBtn').removeClass('d-none');
        }
    </script>
@endpush
