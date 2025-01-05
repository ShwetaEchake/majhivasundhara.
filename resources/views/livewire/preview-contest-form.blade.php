<div class="row pt-5 mb-5">
    <div class="col-12">

        {{-- <div class="row">
            <div class="col-12 col-lg-12 ml-auto mr-auto mb-5 mt-5">
                <div class="multisteps-form__progress">
                    @if ($authUser->category_id != 2)
                        <button class="js-active" style="background-color: #1dbe7254; border-radius: 8px; border: none;" wire:click="$set('show_pd', 1)">पर्यावरण दूत</button>
                    @endif
                    @foreach ($questions as $question)
                        <button class="multisteps-form__progress-btn {{ $section >= $loop->iteration && $show_pd == 0 ? 'js-active' : '' }}" wire:click="$set('show_pd', 0)">{{ $question[0]->department?->name }}</button>
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
                                        <span>{{ $loop->iteration }} of {{ $loop->count }} Completed</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: {{ (($loop->iteration/$loop->count)*100) }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
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
                                                                <a class="btn btn-primary" target="_blank" href="{{ asset('storage/'.$q->userSelectedOption->document_1) }}">View File</a>
                                                            @else
                                                                <img src="{{ asset('storage/'.$q->userSelectedOption->document_1) }}" class="img-fluid" style="max-width: 140px; max-height:140px;border-radius: 8px;border: 1px solid #eee;" alt="">
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
                                                                <a class="btn btn-primary" target="_blank" href="{{ asset('storage/'.$q->userSelectedOption->document_2) }}">View File</a>
                                                            @else
                                                                <img src="{{ asset('storage/'.$q->userSelectedOption->document_2) }}" class="img-fluid" style="max-width: 140px; max-height:140px;border-radius: 8px;border: 1px solid #eee;" alt="">
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
                                {{-- <div class="wizard-footer">

                                    <div class="row px-5">
                                        <div class="col-12 d-flex">
                                            <div class="actions ml-auto">
                                                <ul>
                                                    @if ($loop->first)
                                                        <li><span class="js-btn-prev" wire:click="switchTabFun(1)" wire:loading.attr="disabled" title="BACK"><i class="fa fa-arrow-left"></i> BACK</span></li>
                                                    @endif
                                                    @if (!$loop->first)
                                                        <li><span class="js-btn-prev" wire:click="stepBack()" title="BACK"><i class="fa fa-arrow-left"></i> BACK</span></li>
                                                    @endif
                                                    @if ($loop->last)
                                                        <li><button type="submit" id="submit-form" wire:click.prevent="submitForm" title="NEXT">SUMBIT <i class="fa fa-arrow-right"></i></button></li>
                                                    @else
                                                        <li><span class="js-btn-next" wire:click="stepForward()" title="NEXT">NEXT <i class="fa fa-arrow-right"></i></span></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    @endforeach

                    <div class="multisteps-form__panel js-active slideVert" data-animation="slideVert" >
                        <div class="inner">
                            @livewire('paryavaran-dut-form')
                        </div>
                    </div>

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
