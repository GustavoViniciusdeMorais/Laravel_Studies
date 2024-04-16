<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $article = Article::create($data);

        $result = [
            'data' => $article
        ];

        return response()->json($result, 201);
    }
}
