<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use TCG\Voyager\Models\Post;

class LandingPageController extends Controller
{
    public function index()
    {
        $products = Product::where('featured', true)->take(8)->inRandomOrder()->get();
        $posts = Post::orderBy('created_at','desc')->take(3)->get();

        return view('landing-page')->with([
            'products' => $products,
            'posts' => $posts
            ]);
    }
}
