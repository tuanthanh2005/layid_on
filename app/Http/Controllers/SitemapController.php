<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Utility;
use App\Models\GeminiTrick;
use App\Models\Course;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Tạo file sitemap.xml tự động
     */
    public function index()
    {
        $posts = Post::latest()->get();
        $utilities = Utility::all();
        $geminiTricks = GeminiTrick::latest()->get();
        $courses = Course::all();
        $products = Product::all();

        return response()->view('sitemap', [
            'posts' => $posts,
            'utilities' => $utilities,
            'geminiTricks' => $geminiTricks,
            'courses' => $courses,
            'products' => $products,
        ])->header('Content-Type', 'application/xml');
    }
}
