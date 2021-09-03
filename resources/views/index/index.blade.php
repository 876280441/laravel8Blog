@extends('layout.app')
@section('title','首页')
@section('style')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <style></style>
@endsection
@section('content')
    <div class="jumbotron jumbotron-fluid px-0">
        <div class="container text-center text-white">
            <h4 class="display-6">基于laravel的博客项目</h4>
            <p class="lead">项目仅用于学习</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-body">
                        @if($count>0)
                            @foreach($blogs as $v)
                                <div class="article-body">
                                    <div>
                                        <span class="article-author">{{$v->user->name}}</span>
                                        <span class="article-time">{{($v->updated_at)->diffForHumans()}}</span>
                                    </div>
                                    <h2 class="font-weight-bold my-3 article-title">
                                        <a class="text-dark"
                                           href="{{route('blog.show',$v->id)}}">{{$v->title}}</a>
                                    </h2>
                                    <div class="article-des">{{$v->content}}</div>
                                    <div>
                                        <a href="#"
                                           class="badge badge-warning mt-3 articel-category">{{categories()[$v->category_id]}}</a>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                            {{$blogs->withQueryString()->links()}}<!--显示分页并且如果有get响应参数的话一并添加进去-->
                        @else
                            <div class="article-body">
                                <div>
                                    暂无数据
                                </div>
                            </div>
                        @endif
                        {{--                        <nav class="d-flex justify-content-center mt-4">--}}
                        {{--                            <ul class="pagination">--}}
                        {{--                                <li class="page-item disabled">--}}
                        {{--                                    <a href="#" class="page-link" tabindex="-1" aria-disabled="true">上一页</a>--}}
                        {{--                                </li>--}}
                        {{--                                <li class="page-item">--}}
                        {{--                                    <a href="#" class="page-link">1</a>--}}
                        {{--                                </li>--}}
                        {{--                                <li class="page-item active" aria-current="page">--}}
                        {{--                                    <a href="#" class="page-link">2 <span class="sr-only"></span></a>--}}
                        {{--                                </li>--}}
                        {{--                                <li class="page-item"><a href="#" class="page-link">3</a></li>--}}
                        {{--                                <li class="page-item">--}}
                        {{--                                    <a href="#" class="page-link">下一页</a>--}}
                        {{--                                </li>--}}
                        {{--                            </ul>--}}
                        {{--                        </nav>--}}
                    </div>
                </div>
            </div>
            <div class="col-sm-3 p-0">
                @include('common.right-card',[
    'imgUrl'=>'https://img.yzcdn.cn/vant/cat.jpeg',
    'title'=>'博客网站',
    'content'=>'个人用来学习laravel的博客项目，基于bootstrap4.0开发',
    'count'=>$count
])
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script></script>
@endsection
