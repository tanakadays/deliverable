<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category_genre;
use App\Models\category_title;
use App\Models\category_area;

class CategoryController extends Controller
{
    
    public function genreindex(category_genre $category_genre){
        $apiKey = config('services.google_maps.api_key');
        
        return view('seichi/category/category_genre', compact('apiKey'))->with(['posts' => $category_genre->getByCategoryGenre()]);
    }
    
    public function titleindex(category_title $category_title)
    {
        $apiKey = config('services.google_maps.api_key');
        
        return view('seichi/category/category_title', compact('apiKey'))->with(['posts' => $category_title->getByCategoryTitle()]);
    }
    
    public function areaindex(category_area $category_area)
    {
        $apiKey = config('services.google_maps.api_key');
        
        return view('seichi/category/category_area', compact('apiKey'))->with(['posts' => $category_area->getByCategoryArea()]);
    }
    
}
