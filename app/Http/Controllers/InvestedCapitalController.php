<?php

namespace App\Http\Controllers;

use App\ViewModels\GetInvestedCapitalViewModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvestedCapitalController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('InvestedCapital/Index', [
            'viewModel' => new GetInvestedCapitalViewModel($request->user()),
        ]);
    }
}
