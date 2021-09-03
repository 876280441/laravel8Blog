<header class="header">
    <div class="container bg-light d-flex justify-content-between align-items-center">
        <div class="d-flex">
            <a href="/" class="logo">Laravel</a>
            <form action="{{route('index')}}" method="get" class="form-inline my-2 my-lg-0 ml-3">
                <input type="search" value="{{request()->query('keyword')}}" name="keyword"
                       class="form-control form-control-sm" placeholder="搜索" aria-label="Search">
                <select name="category_id" class="form-control-sm ml-2" id="exampleFormControlSelect1">
                    <option value="0">请选择分类</option>
                    {{--从自定义函数获取分类--}}
                    @foreach(categories() as $id=>$name)
                        <option
                            {{request()->query('category_id')==$id?'selected':''}} value="{{$id}}">{{$name}}</option>
                    @endforeach
                </select>
                <button class="btn btn-sm btn-outline-success ml-2 px-4" type="submit">搜索</button>
            </form>
        </div>
        <div class="right-btn">
            @auth
                <a href="{{route('user.info')}}" class="text-dark mr-3 text-decoration-none">
                    <img width="30" height="30" class="rounded-pill"
                         src="{{avatar(auth()->user()->avatar)}}"
                         alt="">
                    <span>{{auth()->user()->name}}</span>
                </a>
                <a href="{{route('blog.create')}}" class="text-dark mr-3 text-decoration-none">
                    <span>发布博客</span>
                </a>
                <form action="{{route('logout')}}" class="d-inline" id="logout" method="post">
                    @csrf
                    <a href="javascript:;" onclick="document.getElementById('logout').submit()"
                       class="text-dark text-decoration-none">退出</a>
                </form>
            @else
                <a href="{{route('login')}}" class="btn btn-sm btn-primary">登录</a>
                <a href="{{route('register')}}" class="btn btn-sm btn-outline-success ml-2">注册</a>
            @endauth
        </div>
    </div>
</header>
