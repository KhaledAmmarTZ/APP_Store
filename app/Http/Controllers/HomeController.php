<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = \App\Models\Product::with(['images' => function($q) {
            $q->where('status', 'main');
        }])->where('is_featured', 'yes')->take(6)->get();

        return view('welcome', compact('featuredProducts'));
    }
}