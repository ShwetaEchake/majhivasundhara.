<x-admin.admin-layout>
    <x-slot name="title">Field Accessor - Dashboard</x-slot>

    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid dashboard-default-sec">

            <div class="row">
                <div class="col-12 px-0">
                    <div class="card">
                        {{-- <div class="card-header p-3">
                            <h3>All Users</h3>
                        </div> --}}
                        <div class="card-body p-3">

                            <div class="row">
                                @foreach ($wards as $ward)
                                    <div class="col-sm-6 col-xl-3 col-lg-3">
                                        <div class="card custom-card rounded">
                                            <h6 class="card-header rounded bg-primary py-2 px-3 text-center"> {{$ward->name}} </h6>
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-6 br-right text-center">
                                                        <h6 class="mb-0">Final Submit</h6>
                                                        {{-- <strong style="font-size:22px"> <a href="https://kdmc.bioatt.in/shift_wise_employee/eyJpdiI6Ii9WSHFaWldOT2xoUFpHZ3U2QlA5TEE9PSIsInZhbHVlIjoiTUpUSDBIdURVZUh6anNMcnRCODhrUT09IiwibWFjIjoiZTQxNzVhMDM1ZjFjMDM4MWE1MDk4NGQ0ZmU3YzY5NjE4NWE5NWNjZjU0YWUwZjA4ODQ1MzkxYmQxMjFkYjcyMCIsInRhZyI6IiJ9"> 0 </a> </strong> <br> --}}
                                                    </div>
                                                    <div class="col-6 text-center">
                                                        <h6 class="mb-0">Accessor Action</h6>
                                                        {{-- <a href="https://kdmc.bioatt.in/shift_wise_employee/eyJpdiI6Illvb2QraC9yMUZQRDFYZE9EL0VtOWc9PSIsInZhbHVlIjoiQ3p5T1RLUHdtSmVnVFBSZUhubThndz09IiwibWFjIjoiNDEyMzQzMGYyYjhhYWExMWJiYmZmMTEwZDU1YTRlN2FkZDNkNjg2YmYzYjk3MWYxNjdlYzkzZjAxODA5MDI1MSIsInRhZyI6IiJ9"> <strong style="font-size:22px; display:inline-block;">0 <span style="font-size:14px; display:inline-block;">(0%)</span></strong></a> <br> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-footer row p-0">
                                                <div class="col-6 col-sm-6">
                                                    {{-- <h6 class="color-black">Before Time</h6> --}}
                                                    <h3><span class="counter" style="font-size:20px">109</span><span style="font-size:12px">( 0%)</span></h3>
                                                </div>
                                                <div class="col-6 col-sm-6">
                                                    {{-- <h6 class="color-black">After Time</h6> --}}
                                                    <h3><span class="counter" style="font-size:20px">57</span><span style="font-size:12px">(0%)</span></h3>
                                                </div>
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
