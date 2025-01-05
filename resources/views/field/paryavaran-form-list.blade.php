<x-admin.admin-layout>
    <x-slot name="title"> {{ $ward->name }} - पर्यावरण संवर्धन कृती स्पर्धा</x-slot>

    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid dashboard-default-sec">

            <div class="row">
                <div class="col-12 px-0">
                    <div class="card">
                        <div class="card-header p-2">
                            <h3>Ward - {{ $ward->name }}</h3>
                        </div>

                        <div class="card-body p-2">
                            <div class="row">
                                @foreach ($formsList as $user)
                                    <div class="col-12">
                                        <div class="card" style="font-size: 12px">
                                            {{-- <div class="card-header p-0" style="position: absolute; right: 4px; top: 4px; z-index: 9">
                                                <a class="btn btn-primary py-1 px-3" href="{{ route('field.paryavaran_form.view', $user->id) }}"><i class="fas fa-eye"></i></a>
                                            </div> --}}
                                            <div class="card-body p-2">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <strong>Competition Type</strong>
                                                    </div>
                                                    <div class="col-8">
                                                        Paryavaran Spardha
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <strong>Category</strong>
                                                    </div>
                                                    <div class="col-8">
                                                        {{ ucfirst($user->category?->name) }}
                                                    </div>
                                                </div>

                                                <div class="row top-brdr">
                                                    <div class="col-4">
                                                        <strong>Society Name</strong>
                                                    </div>
                                                    <div class="col-8">
                                                        {{ $user->building_name }}
                                                    </div>
                                                </div>

                                                <div class="row top-brdr">
                                                    <div class="col-4">
                                                        <strong>Address</strong>
                                                    </div>
                                                    <div class="col-8">
                                                        {{ $user->area_name ? $user->area_name.' ,' : '' }} {{ $user->landmark ? $user->landmark.' ,' : '' }} {{ $user->city ? $user->city.' ,' : '' }} {{ $user->pincode }}
                                                    </div>
                                                </div>

                                                <div class="row top-brdr">
                                                    <div class="col-4">
                                                        <strong>NP Name</strong>
                                                    </div>
                                                    <div class="col-8">
                                                        {{ $user->nodal_person_name }}
                                                    </div>
                                                </div>

                                                <div class="row top-brdr">
                                                    <div class="col-4">
                                                        <strong>NP Contact</strong>
                                                    </div>
                                                    <div class="col-8">
                                                        {{ $user->nodal_person_contact }}
                                                    </div>
                                                </div>

                                                <div class="row top-brdr">
                                                    <div class="col-4">
                                                        <strong>Total Marks</strong>
                                                    </div>
                                                    <div class="col-8">
                                                        100
                                                    </div>
                                                </div>

                                                <div class="row top-brdr">
                                                    <div class="col-4">
                                                        <strong>Obtained</strong>
                                                    </div>
                                                    <div class="col-8">
                                                        @php
                                                            $finalPDMarks = $user->contestent_pd_count > $user->paryavaran_seva_marks ? $user->contestent_pd_count : $user->paryavaran_seva_marks;
                                                        @endphp
                                                        {{ $user->contests_sum_marks_obtained-$user->paryavaran_seva_marks+$finalPDMarks }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer p-1">
                                                <a class="btn btn-primary py-1 px-3 float-end" href="{{ route('field.paryavaran_form.view', $user->id) }}">{{ $user->field_submitted_user_id ? 'पहा' : 'निरिक्षण करा' }}</a>
                                                <a class="btn btn-primary py-1 px-3 float-start" href="{{ route('field.paryavaran_dut_form.view', $user->id) }}">पर्यावरण दूत </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- Container-fluid Ends-->
    </div>

</x-admin.admin-layout>
