<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_title extends Model
{
    use HasFactory;
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function getByCategoryTitle(int $limit_count = 5)
    {
        return $this->posts()->with('category_title')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function getOrder()
    {
        return $this->orderByRaw("CASE WHEN name = 'その他' THEN 1 ELSE 0 END")->orderBy('name')->get();

    }
    
    
}
