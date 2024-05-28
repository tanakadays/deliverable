<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
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
        
        
        return view('seichi/index')->with(['posts' => $post->getPaginateByLimit()]);
    }
    
    public function show(Post $post)
    {
        return view('seichi/show')->with(['post' => $post]);
    }
    
    public function create()
    {
        $apiKey = config('services.google_maps.api_key');
        return view('seichi/create', compact('apiKey'));
    }
    
    public function store(Post $post, PostRequest $request)
    {
        $input = $request['post'];
        
        if($request->file('image')){
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input += [ 'image_url' => $image_url];
        }
        
        $post->category_genre_id = 1;
        $post->category_title_id = 1;
        $post->category_area_id = 1;
        $post->user_id= 1;
        $post->fill($input)->save();
        return redirect('/posts/'. $post->id);
    }
    
    public function edit(Post $post)
    {
        return view('seichi/edit') ->with(['post'=>$post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
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
}
