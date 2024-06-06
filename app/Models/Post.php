<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'place_name',
        'genre',
        'title_name',
        'area',
        'information',
        'image_url',
        'longitude',
        'latitude',
        'category_genre_id',
        'category_title_id',
        'category_area_id'
        ];
    
    public function getPaginateByLimit(int $limit_count=10)
    {
        return $this::with('category_genre')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function category_genre()
    {
        return $this->belongsTo(category_genre::class);
    }
    
    public function category_title()
    {
        return $this->belongsTo(category_title::class);
    }
    
    public function category_area()
    {
        return $this->belongsTo(category_area::class);
    }
}
