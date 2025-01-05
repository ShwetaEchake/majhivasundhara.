<x-admin.admin-layout>
    <x-slot name="title">Majhi Vasundara - Dashboard</x-slot>

    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid dashboard-default-sec">

            <div class="row">
                <div class="col-12 px-0">
                    <div class="card">
                        <div class="card-header p-3">
                            <h3>All Users</h3>
                        </div>
                        <div class="card-body p-3">

                            @if ($isAdmin)

                                <div class="row">
                                    @foreach ($categoryWiseUsers as $category)
                                        <div class="col-sm-6 col-xl-3 col-lg-3">
                                            <div class="card o-hidden border-0 mb-2">
                                                <div class="bg-blue b-r-4 card-body p-3">
                                                    <div class="media static-top-widget">
                                                        <div class="media-body"><span class="m-0">{{ $category->name }}</span>
                                                            <h4 class="mb-0 counter"> {{ $category->users_count }} </h4><i class="icon-bg" data-feather="user"></i>
                                                            {{-- <h4 class="mb-0 counter"> {{ $category->users->contests_count }} </h4><i class="icon-bg" data-feather="user"></i> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="col-sm-6 col-xl-3 col-lg-3">
                                        <div class="card o-hidden border-0 mb-2">
                                            <div class="bg-blue b-r-4 card-body p-3">
                                                <div class="media static-top-widget">
                                                    <div class="media-body"><span class="m-0">जनजागृती व्यक्ती</span>
                                                        <h4 class="mb-0 counter"> {{ $individualJJCount }} </h4><i class="icon-bg" data-feather="user"></i>
                                                        {{-- <h4 class="mb-0 counter"> {{ $category->users->contests_count }} </h4><i class="icon-bg" data-feather="user"></i> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xl-3 col-lg-3">
                                        <div class="card o-hidden border-0 mb-2">
                                            <div class="bg-blue b-r-4 card-body p-3">
                                                <div class="media static-top-widget">
                                                    <div class="media-body"><span class="m-0">जनजागृती सोसायटी</span>
                                                        <h4 class="mb-0 counter"> {{ $societyJJCount }} </h4><i class="icon-bg" data-feather="user"></i>
                                                        {{-- <h4 class="mb-0 counter"> {{ $category->users->contests_count }} </h4><i class="icon-bg" data-feather="user"></i> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @else

                                <div class="row">
                                    @foreach ($departmentWiseData as $department)
                                        <div class="col-sm-6 col-xl-3 col-lg-3">
                                            <div class="card o-hidden border-0 mb-2">
                                                <div class="bg-blue b-r-4 card-body p-3">
                                                    <div class="media static-top-widget">
                                                        <div class="media-body"><span class="m-0">{{ $department->name }}</span>
                                                            <h4 class="mb-0 counter"> {{ $department?->users?->contests_count }} </h4><i class="icon-bg" data-feather="user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            @endif
                        </div>
                    </div>
                </div>



                <div class="col-12 px-0 mt-5">
                    <div class="card">
                        <div class="card-header p-3">
                            <h3>Final Submitted Users</h3>
                        </div>
                        <div class="card-body p-3">

                            <div class="row">
                                {{-- @foreach ($competitionWiseContestentOne as $contestentOne) --}}
                                    <div class="col-sm-6 col-xl-3 col-lg-3">
                                        <div class="card o-hidden border-0 mb-2">
                                            <div class="bg-blue b-r-4 card-body p-3">
                                                <div class="media static-top-widget">
                                                    <div class="media-body"><span class="m-0"> गृहसंकुल </span>
                                                        <h4 class="mb-0 counter"> {{ array_key_exists(1, $competitionWiseContestentOne) ? count($competitionWiseContestentOne[1]) : 0 }} </h4><i class="icon-bg" data-feather="user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xl-3 col-lg-3">
                                        <div class="card o-hidden border-0 mb-2">
                                            <div class="bg-blue b-r-4 card-body p-3">
                                                <div class="media static-top-widget">
                                                    <div class="media-body"><span class="m-0"> शैक्षणिक संस्था (ठामपा शाळा) </span>
                                                        <h4 class="mb-0 counter"> {{ array_key_exists(2, $competitionWiseContestentOne) ? count($competitionWiseContestentOne[2]) : 0 }} </h4><i class="icon-bg" data-feather="user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xl-3 col-lg-3">
                                        <div class="card o-hidden border-0 mb-2">
                                            <div class="bg-blue b-r-4 card-body p-3">
                                                <div class="media static-top-widget">
                                                    <div class="media-body"><span class="m-0"> शैक्षणिक संस्था (खाजगी शाळा / कनिष्ठ महाविद्यालये ) </span>
                                                        <h4 class="mb-0 counter"> {{ array_key_exists(3, $competitionWiseContestentOne) ? count($competitionWiseContestentOne[3]) : 0 }} </h4><i class="icon-bg" data-feather="user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xl-3 col-lg-3">
                                        <div class="card o-hidden border-0 mb-2">
                                            <div class="bg-blue b-r-4 card-body p-3">
                                                <div class="media static-top-widget">
                                                    <div class="media-body"><span class="m-0"> सरकारी आणि व्यापारी संस्था (हॉस्पिटल ,हॉटेल्स, वरिष्ठ महाविद्यालये , सरकारी कार्यालये , खाजगी कार्यालये ) </span>
                                                        <h4 class="mb-0 counter"> {{ array_key_exists(4, $competitionWiseContestentOne) ? count($competitionWiseContestentOne[4]) : 0 }} </h4><i class="icon-bg" data-feather="user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- @endforeach --}}
                                <div class="col-sm-6 col-xl-3 col-lg-3">
                                    <div class="card o-hidden border-0 mb-2">
                                        <div class="bg-blue b-r-4 card-body p-3">
                                            <div class="media static-top-widget">
                                                <div class="media-body"><span class="m-0">जनजागृती व्यक्ती</span>
                                                    <h4 class="mb-0 counter"> {{ array_key_exists(0, $competitionWiseContestentTwo) ? count($competitionWiseContestentTwo[0]) : 0 }} </h4><i class="icon-bg" data-feather="user"></i>
                                                    {{-- <h4 class="mb-0 counter"> {{ $category->users->contests_count }} </h4><i class="icon-bg" data-feather="user"></i> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3 col-lg-3">
                                    <div class="card o-hidden border-0 mb-2">
                                        <div class="bg-blue b-r-4 card-body p-3">
                                            <div class="media static-top-widget">
                                                <div class="media-body"><span class="m-0">जनजागृती सोसायटी</span>
                                                    <h4 class="mb-0 counter"> {{ array_key_exists(1, $competitionWiseContestentTwo) ? count($competitionWiseContestentTwo[1]) : 0 }} </h4><i class="icon-bg" data-feather="user"></i>
                                                    {{-- <h4 class="mb-0 counter"> {{ $category->users->contests_count }} </h4><i class="icon-bg" data-feather="user"></i> --}}
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
        <!-- Container-fluid Ends-->
    </div>

</x-admin.admin-layout>

