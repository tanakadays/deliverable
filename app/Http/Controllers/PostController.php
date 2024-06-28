<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\category_genre;
use App\Models\category_title;
use App\Models\category_area;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;


use Cloudinary;

use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    
    public function index(Post $post)
    {
        
        $apiKey = config('services.google_maps.api_key');
        
        return view('seichi/index', compact('apiKey'))->with(['posts' => $post->getPaginateByLimit(50)]);
    }
    
    public function show(Post $post)
    {
        return view('seichi/show')->with(['post' => $post]);
    }
    
    public function create(category_genre $category_genre, category_title $category_title, category_area $category_area)
    {
        $apiKey = config('services.google_maps.api_key');
        return view('seichi/create', compact('apiKey'))->with(['category_genres'=>$category_genre->getOrder(), 'category_titles'=>$category_title->getOrder(), 'category_areas'=>$category_area->get()]);
    }
    
    public function store(Post $post, PostRequest $request, category_genre $category_genre, category_title $category_title, category_area $category_area)
    {
        $input = $request['post'];
        
        if($request->file('image')){
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input += [ 'image_url' => $image_url];
        }
        
        
        $post->fill($input);
        
        
        if($post->category_title_id == 4){
            $category_title->name = $post->title_name;
            $category_title->save();
            $post->category_title_id = $category_title->id;
        }
        
        if($post->category_genre_id == 5){
            $category_genre->name = $post->genre;
            $category_genre->save();
            $post->category_genre_id = $category_genre->id;
        }
        
        
        
        if($post->category_area_id == 48){
            $category_area->name = $post->area;
            $category_area->save();
            $post->category_area_id = $category_area->id;
        }
        
        $post->user_id = Auth::id();
        
        $post->save();
        return redirect('/posts/'. $post->id);
    }
    
    public function edit(Post $post, category_genre $category_genre, category_title $category_title, category_area $category_area)
    {
        $apiKey = config('services.google_maps.api_key');
        return view('seichi/edit', compact('apiKey'))->with(['post'=>$post, 'category_genres'=>$category_genre->getOrder(), 'category_titles'=>$category_title->getOrder(), 'category_areas'=>$category_area->get()]);
    }
    
    public function update(Post $post, PostRequest $request, category_genre $category_genre, category_title $category_title, category_area $category_area)
    {
        
        $input_post = $request['post'];
        if($request->file('image')){
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input_post += [ 'image_url' => $image_url];
        }
        
        
        
        $post->fill($input_post);
        
        #dd($post);
        
        if($post->category_genre_id == 5){
            $category_genre->name = $post->genre;
            $category_genre->save();
            $post->category_genre_id = $category_genre->id;
        }
        
        if($post->category_title_id == 4){
            $category_title->name = $post->title_name;
            $category_title->save();
            $post->category_title_id = $category_title->id;
        }
        
        
        if($post->category_area_id == 48){
            $category_area->name = $post->area;
            $category_area->save();
            $post->category_area_id = $category_area->id;
        }
        
        $post->user_id = Auth::id();
        
        $post->save();
        
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
    
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['like', 'unlike']);
    }
     
     public function like($id)
    {
        Like::create([
          'post_id' => $id,
          'user_id' => Auth::id(),
        ]);
    
        session()->flash('success', 'You Liked the Post.');
    
        return redirect()->back();
    }
     
    public function unlike($id)
    {
        $like = Like::where('post_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();
    
        session()->flash('success', 'You Unliked the post.');
    
        return redirect()->back();
    }
    
    public function mypage()
    {
        $user = Auth::user();
        $userLikes = $user->likes()->get();
        
        return view('seichi/mypage') -> with(["userLikes"=>$userLikes]);
    }

}
