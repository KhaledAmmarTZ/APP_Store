<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with(['images' => function($q) {
            $q->where('status', 'main');
        }])->where('is_featured', 'yes')->take(6)->get();

        $sliderProducts = Product::with(['images' => function($q) {
            $q->where('status', 'main');
        }])
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

        $discountProducts = Product::with(['images' => function($q) {
            $q->where('status', 'main');
        }])
        ->whereColumn('product_price', '>', 'final_price')
        ->orderByRaw('(product_price - final_price) DESC')
        ->take(10)
        ->get();
        // dd($discountProducts->count(), $discountProducts->pluck('id'));

        $freeProducts = \App\Models\Product::with(['images' => function($q) {
            $q->where('status', 'main');
        }])
        ->where('is_free', 'yes')
        ->take(2)
        ->get();

        return view('welcome', compact(
            'featuredProducts',
            'sliderProducts',
            'discountProducts',
            'freeProducts' // add this
        ));
    }
}