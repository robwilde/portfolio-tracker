<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\ViewModels\GetPortfolioViewModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index(Request $request, Portfolio $portfolio)
    {
        $portfolio->load('holdings');

        return Inertia::render('Portfolio/Index', [
            'viewModel' => new GetPortfolioViewModel($request->user(), $portfolio),
        ]);
    }
}
