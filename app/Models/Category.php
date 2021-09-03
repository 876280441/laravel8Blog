<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * 该分类拥有的博客
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id', 'id');
    }
}
