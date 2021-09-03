<h2 style="color: red;font-size: 25px">您有新的评论</h2>
<div style="color: #1c7430">用户:</div>
<div style="font-size: 20px">{{ $comment->user->name }}</div>
<br>
<div style="font-size: 20px">对您的博客[
    <span style="font-size: 20px;color: red">{{ $comment->blog->title }}</span>] 进行了评论:
</div>
<br>
<div>
    {{ $comment->content }}
</div>
