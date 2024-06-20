<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_area extends Model
{
    use HasFactory;
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function getByCategoryArea(int $limit_count = 5)
    {
     return $this->posts()->with('category_area')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    
}
