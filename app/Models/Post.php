<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['title',
    'slug',
    'description',
    'content',
    'status',
    'comment_able',
    'admin_id',
    'category_id'];
    public function Category(){
        return $this->belongsTo(Category::class);
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
