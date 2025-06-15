<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query()->whereNull('deleted_at');

        // Handle search by header
        if ($search = trim($request->query('search'))) {
            $query->where('header', 'like', '%' . $search . '%');
        }

        // Handle sorting
        $sort = $request->query('sort', 'newest');
        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $news = $query->get();

        return view('pages.news', compact('news'));
}

    public function showNewsDetails($id)
    {
        $news = News::findOrFail($id);
        return view('pages.news-details', compact('news'));
    }
}