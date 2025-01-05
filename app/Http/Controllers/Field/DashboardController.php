<?php

namespace App\Http\Controllers\Field;

use App\Http\Controllers\Controller;
use App\Models\Ward;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $authUser = auth()->user();

        $wards = Ward::query()
                        ->withCount(['users' => fn($q) => $q->where('is_submitted', 1)])
                        ->withCount(['users' => fn($q) => $q->where('is_submitted', 1)])
                        ->get();


        return view('field.dashboard')->with(['wards' => $wards]);
    }
}
