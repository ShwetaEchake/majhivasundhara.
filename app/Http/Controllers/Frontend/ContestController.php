<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //TODO: this function is no longer in use remove it after sometime
    {
        return view('frontend.contest-form');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if( Carbon::today()->lt( env('EVENT_START_DATE') ) )
            return view('frontend.coming-soon')->with(['contestDate'=> env('EVENT_START_DATE')]);

        return view('frontend.contest-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function paryavaranDutForm()
    {
        if( Carbon::today()->lt( env('EVENT_START_DATE') ) )
            return view('frontend.coming-soon')->with(['contestDate'=> env('EVENT_START_DATE')]);

        $authUser = auth()->user();

        return view('frontend.paryavaran-dut-form')->with(['authUser'=> $authUser]);
    }
}
