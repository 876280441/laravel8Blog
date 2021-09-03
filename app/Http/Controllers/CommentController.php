<?php

namespace App\Http\Controllers;

use App\Jobs\CommentEmail;
use App\Mail\BlogComment;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * 评论控制器（单行为）
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Blog $blog)
    {
        $request->all();
        $comment = $blog->comments()->create([
            'user_id' => auth()->user()->id,
            'content' => $request->input('content')
        ]);
        if ($comment) {
            //返回用户头像和呢称
            $resData = [
                'avatar_url' => avatar(auth()->user()->avatar),
                'user_name' => auth()->user()->name,
                'content' => $request->input('content')
            ];

            //使用队列发邮件--自定义队列
            // CommentEmail::dispatch($comment);
            //使用队列发送邮件--laravel邮件自带的队列
            //发送邮件，通知作者有新的评论 to()里面可以传用户模型/邮箱地址/数组里面写多个邮箱地址
            Mail::to($comment->blog->user)->queue(new BlogComment($comment));
            return response()->api('评论成功', 200, $resData);
        } else {
            return response()->api('评论失败', 400);
        }
    }
}
