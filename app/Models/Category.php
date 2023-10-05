<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,Sluggable;
    protected $fillable = ['name', 'slug', 'image', 'parent_id', 'admin_id', 'status'];
  
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')
            ->withDefault([
                'name' => '-'
            ]);
    }
    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}
