<?php
//自定义的辅助函数


/*
 * 返回博客分类
 */
if (!function_exists('categories')) {
    function categories()
    {
        //使用缓存处理获取分类请求--永久缓存
        $categories = cache()->rememberForever('categories', function () {
            //查询数据库
            $categories = \Illuminate\Support\Facades\DB::table('categories')
                ->pluck('name', 'id');//以id为键，name为值
            return $categories;
        });
        return $categories;
    }
}

/**
 * 返回头像地址
 */
if (!function_exists('avatar')) {
    function avatar($avatar)
    {
        $avatar_url = $avatar ? asset('storage/' . $avatar) : asset('img/default/it.jpg');
        return $avatar_url;
    }
}
