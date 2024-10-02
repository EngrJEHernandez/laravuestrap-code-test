<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Get the search term from the request
        $search = $request->input('search');

        // Fetch paginated posts with filtering based on the title
        $posts = Post::when($search, function ($query) use ($search) {
            return $query->where('title', 'like', '%'.$search.'%');
        })->paginate(10); // Change the number for posts per page

        return Inertia::render('Dashboard', [
            'posts' => $posts,
            'search' => $search, // Pass the search term back to the view
        ]);
    }
}
