<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\category_genre;
use App\Models\category_title;
use App\Models\category_area;

use Cloudinary;

use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function geocode()
    {
        $apiKey = config('services.google_maps.api_key');
        
        return view('seichi.geocode', compact('apiKey'));
    }
    
    
    public function index(Post $post)
    {
        
        $apiKey = config('services.google_maps.api_key');
        
        return view('seichi/index', compact('apiKey'))->with(['posts' => $post->getPaginateByLimit()]);
    }
    
    public function show(Post $post)
    {
        return view('seichi/show')->with(['post' => $post]);
    }
    
    public function create(category_genre $category_genre, category_title $category_title, category_area $category_area)
    {
        $apiKey = config('services.google_maps.api_key');
        return view('seichi/create', compact('apiKey'))->with(['category_genres'=>$category_genre->get(), 'category_titles'=>$category_title->get(), 'category_areas'=>$category_area->get()]);
    }
    
    public function store(Post $post, PostRequest $request, category_genre $category_genre, category_title $category_title, category_area $category_area)
    {
        $input = $request['post'];
        
        if($request->file('image')){
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input += [ 'image_url' => $image_url];
        }
        
        $post->user_id= 1;
        $post->fill($input);
        
        if($post->category_genre_id == 5){
            $category_genre->name = $post->genre;
            $category_genre->save();
            $post->category_genre_id = $category_genre->id;
        }
        
        if($post->category_title_id == 1){
            $category_title->name = $post->title_name;
            $category_title->save();
            $post->category_title_id = $category_title->id;
        }
        
        if($post->category_area_id == 48){
            $category_area->name = $post->area;
            $category_area->save();
            $post->category_area_id = $category_area->id;
        }
        
        $post->save();
        return redirect('/posts/'. $post->id);
    }
    
    public function edit(Post $post)
    {
        $apiKey = config('services.google_maps.api_key');
        return view('seichi/edit', compact('apiKey')) ->with(['post'=>$post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        
        $input_post = $request['post'];
        if($request->file('image')){
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input_post += [ 'image_url' => $image_url];
        }
        
        $post->fill($input_post)->save();
        $post->category_genre_id = 1;
        $post->category_title_id = 1;
        $post->category_area_id = 1;
        $post->user_id= 1;
        return redirect('/posts/'.$post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Post::query();
        
        if(!empty($keyword)) {
            $query->where('place_name', 'LIKE', "%{$keyword}%");
        }

        $posts = $query->orderBy('updated_at', 'DESC')->paginate(1);

        return view('seichi/search')->with(["posts"=>$posts]);
    }

}
