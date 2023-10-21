<?php

namespace App\Http\Controllers;

use App\ViewModels\GetDashboardViewModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Dashboard', [
            'viewModel' => new GetDashboardViewModel($request->user()),
        ]);
    }
}
