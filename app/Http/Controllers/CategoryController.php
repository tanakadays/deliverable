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
        $title = $category_genre->name;
        return view('seichi/category/category_genre', compact('apiKey'))->with(['posts' => $category_genre->getByCategoryGenre(), 'title' => $title]);
    }
    
    public function titleindex(category_title $category_title)
    {
        $apiKey = config('services.google_maps.api_key');
        $title = $category_title->name;
        return view('seichi/category/category_title', compact('apiKey'))->with(['posts' => $category_title->getByCategoryTitle(), 'title' => $title]);
    }
    
    public function areaindex(category_area $category_area)
    {
        $apiKey = config('services.google_maps.api_key');
        $title = $category_area->name;
        return view('seichi/category/category_area', compact('apiKey'))->with(['posts' => $category_area->getByCategoryArea(), 'title' => $title]);
    }
    
    public function titlelist(category_title $category_title)
    {
        return view('seichi/category/titlelist')-> with(['category_titles'=>$category_title->get()]);
    }
    
    public function genrelist(category_genre $category_genre)
    {
        return view('seichi/category/genrelist')-> with(['category_genres'=>$category_genre->get()]);
    }
    
    public function arealist(category_area $category_area)
    {
        return view('seichi/category/arealist')-> with(['category_areas'=>$category_area->get()]);
    }
    
}
