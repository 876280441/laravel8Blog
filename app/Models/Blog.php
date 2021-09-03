<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /**
     * 可批量赋值属性
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'category_id', 'user_id'];

    /**
     * 博客所属的用户
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * 博客属于哪个分类
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * 博客拥有的评论
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_id', 'id');
    }
    /**
     * 模型的 "booted" 方法
     *
     * @return void
     */
    protected static function booted()
    {
        /**
         * 模型删除事件
         */
//        static::deleted(function ($blog) {
//            info('删除了博客:' . $blog->title);
//        });
    }
}
