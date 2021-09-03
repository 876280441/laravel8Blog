<div class="card">
    <ul class="list-group list-group-flush text-center text-dark ">
        <li class="list-group-item {{$nav=='info'?' bg-success':''}}">
            <a href="{{route('user.info')}}" class="{{$nav=='info'?'text-while':''}}">个人信息</a>
        </li>
        <li class="list-group-item {{$nav=='avatar'?'bg-success':''}}">
            <a href="{{route('user.avatar')}}" class="{{$nav=='avatar'?'text-while':''}}">修改头像</a>
        </li>
        <li class="list-group-item {{$nav=='blog'?'bg-success':''}}">
            <a href="{{route('user.blog')}}" class="{{$nav=='blog'?'text-while':''}}">所有博客</a>
        </li>
    </ul>
</div>
