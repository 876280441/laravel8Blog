<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //首页
    public function Index(Request $request)
    {
        //搜索关键字
        $keyword = $request->query('keyword');
        //获取分类id
        $category_id = $request->query('category_id');
        //查询博客数据
        //如果这个关键字为空，就不进行闭包操作，直接查询数据
        //when()就是如果变量值存在，就执行里面的闭包操作，如果不存在就会跳过闭包操作
        $blogs = Blog::when($keyword, function ($query) use ($keyword) {
            //将一个闭包套在组里面，不会影响全局的SQL
            $query->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%")
                    ->orWhere('content', 'like', "%{$keyword}%");
            });
        })->when($category_id, function ($query) use ($category_id) {
            $query->where('category_id', '=', $category_id);
        })->with('user:id,name')
            ->where('status', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(7);
        return view('index.index', ['blogs' => $blogs, 'count' => $blogs->total()]);
    }
}
