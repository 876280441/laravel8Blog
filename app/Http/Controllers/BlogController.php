<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    /**
     * 构造方法，中间件的验证
     *需要验证成功才可访问
     * @return void
     */
    public function __construct()
    {
        //排除show方法的中间件验证
        $this->middleware('auth')->except('show');

    }

    /**
     * 添加博客页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * 执行博客添加
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        //设置请求中的字段，也就是把这个字段添加进去
        $request->offsetSet('user_id', auth()->id());
        $res = Blog::create(
        //排除请求中的_token字段
            $request->except(['_token'])
        );
        //另外一种方式
//        $blog->user_id = auth()->id();
//        $blog->title = $request->input('title');
//        $blog->content = $request->input('content');
//        $blog->category_id = $request->input('category_id');
//        $res = $blog->save();
        if ($res) {
            return back()->with(['success' => '博客发布成功']);
        } else {
            return back()->withErrors('博客发布失败')->withInput();
        }
    }

    /**
     * 查看一条博客
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //预加载，把全部数据都查出来了，然后在模板的时候使用数据的时候是不会再去查询数据库了
        //只是会去遍历数据了
        $blog = Blog::with('comments.user')->where('id', $id)->first();
        //禁用模型维护时间戳
        $blog->timestamps = false;
        //模型数据自增
        $blog->increment('view');
        //开启模型维护时间戳
        $blog->timestamps = true;
        return view('blog.show', ['blog' => $blog]);
    }

    /**
     * 编辑页面
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blog.edit', ['blog' => $blog]);
    }

    /**
     * 执行编辑
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        //方式1
//        $blog->title = $request->input('title');
//        $blog->content = $request->input('content');
//        $blog->category_id = $request->input('category_id');
//        $res = $blog->save();
        //方式二
        $blog->fill($request->except(['_token', '_method']));
        $res = $blog->save();
        if ($res) {
            return back()->with(['success' => '修改成功']);
        } else {
            return back()->withErrors('修改失败')->withInput();

        }
    }

    /**
     * 删除博客
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //开启事务
        DB::beginTransaction();
        try {
            //删除博客
            $blog->delete();
            //提交事务
            DB::commit();
            return response()->api('删除成功');
        } catch (\ Exception $e) {
            DB::rollBack();
            return response()->api('删除失败', 400);
        }
    }

    /*
     * 修改博客状态
     * @param int $id
     */
    public function status(Blog $blog)
    {
        //临时禁用模型维护时间
        $blog->timestamps = false;
        $blog->status = $blog->status == 1 ? 0 : 1;
        $res = $blog->save();
        if ($res) {
            $msg = $blog->status == 1 ? '显示成功' : '已取消显示';
            return response()->api($msg);
        } else {
            return response()->api('显示失败', 400);
        }
    }
}
