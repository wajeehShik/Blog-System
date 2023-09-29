<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'key',
        'value',
        'admin_id', 'status'
    ];
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
