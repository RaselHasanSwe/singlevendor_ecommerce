<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\OrderComplete;
use App\Models\HomeSlider;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        //dispatch(new OrderComplete())->delay(now()->addSecond(5));



        $data['slider'] = HomeSlider::latest()->get();
        $data['hot_products'] = Product::where('hot', 1)
            ->with('category','subCategory','innerCategory','images','sizes','colors','variations')
            ->latest()
            ->take(18)
            ->get();

        $data['recomended_products'] = Product::where('recomend', 1)
            ->with('category','subCategory','innerCategory','images','sizes','colors','variations')
            ->latest()
            ->take(18)
            ->get();

        return view('frontend.home.index', $data);
    }
}
