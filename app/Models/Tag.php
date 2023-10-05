<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory,Sluggable;
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    protected $fillable = ['name', 'slug', 'admin_id', 'status'];
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    
    public function posts()
    {
        return $this->belongsToMany(Artical::class, 'posts_tags')->withTimestamps();
    }
}
