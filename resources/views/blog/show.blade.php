@extends('layout.app')
@section('title','博客详情')
@section('style')
    <style>
        .replay:last-child {
            border-bottom: none !important;
        }

        img {
            max-width: 100%;
        }

        h1, h2, h3, h4 {
            color: #111111;
            font-weight: 400;
            margin-top: 1em;
        }

        h1, h2, h3, h4, h5 {
            font-family: Georgia, Palatino, serif;
        }

        h1, h2, h3, h4, h5, dl {
            margin-bottom: 16px;
            padding: 0;
        }

        p {
            margin-top: 8px;
            margin-bottom: 3px;
        }

        h1 {
            font-size: 48px;
            line-height: 54px;
        }

        h2 {
            font-size: 36px;
            line-height: 42px;
        }

        h1, h2 {
            border-bottom: 1px solid #EFEAEA;
            padding-bottom: 10px;
        }

        h3 {
            font-size: 24px;
            line-height: 30px;
        }

        h4 {
            font-size: 21px;
            line-height: 26px;
        }

        h5 {
            font-size: 18px;
            line-height: 23px;
        }

        a {
            color: #0099ff;
            margin: 0 2px;
            padding: 0;
            vertical-align: baseline;
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
            color: #ff6600;
        }

        a:visited {
            /*color: purple;*/
        }

        ul, ol {
            padding: 0;
            padding-left: 18px;
            margin: 0;
        }

        li {
            line-height: 24px;
        }

        p, ul, ol {
            font-size: 16px;
            line-height: 24px;
        }

        ol ol, ul ol {
            list-style-type: lower-roman;
        }

        code, pre {
            font-family: Consolas, Monaco, Andale Mono, monospace;
            background-color: #f7f7f7;
            color: inherit;
        }

        code {
            font-family: Consolas, Monaco, Andale Mono, monospace;
            margin: 0 2px;
        }

        pre {
            font-family: Consolas, Monaco, Andale Mono, monospace;
            line-height: 1.7em;
            overflow: auto;
            padding: 6px 10px;
            border-left: 5px solid #6CE26C;
        }

        pre > code {
            font-family: Consolas, Monaco, Andale Mono, monospace;
            border: 0;
            display: inline;
            max-width: initial;
            padding: 0;
            margin: 0;
            overflow: initial;
            line-height: 1.6em;
            font-size: .95em;
            white-space: pre;
            background: 0 0;

        }

        code {
            color: #666555;
        }

        aside {
            display: block;
            float: right;
            width: 390px;
        }

        blockquote {
            border-left: .5em solid #eee;
            padding: 0 0 0 2em;
            margin-left: 0;
        }

        blockquote cite {
            font-size: 14px;
            line-height: 20px;
            color: #bfbfbf;
        }

        blockquote cite:before {
            content: '\2014 \00A0';
        }

        blockquote p {
            color: #666;
        }

        hr {
            text-align: left;
            color: #999;
            height: 2px;
            padding: 0;
            margin: 16px 0;
            background-color: #e7e7e7;
            border: 0 none;
        }

        dl {
            padding: 0;
        }

        dl dt {
            padding: 10px 0;
            margin-top: 16px;
            font-size: 1em;
            font-style: italic;
            font-weight: bold;
        }

        dl dd {
            padding: 0 16px;
            margin-bottom: 16px;
        }

        dd {
            margin-left: 0;
        }

        table {
            *border-collapse: collapse; /* IE7 and lower */
            border-spacing: 0;
            width: 100%;
        }

        table {
            border: solid #ccc 1px;
        }

        table thead {
            background: #f7f7f7;
        }

        table thead tr:hover {
            background: #f7f7f7
        }

        table tr:hover {
            background: #fbf8e9;
            -o-transition: all 0.1s ease-in-out;
            -webkit-transition: all 0.1s ease-in-out;
            -moz-transition: all 0.1s ease-in-out;
            -ms-transition: all 0.1s ease-in-out;
            transition: all 0.1s ease-in-out;
        }

        table td, .table th {
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        table th {
            border-top: none;
            text-shadow: 0 1px 0 rgba(255, 255, 255, .5);
            padding: 5px;
            border-left: 1px solid #ccc;
        }

        table td:first-child, table th:first-child {
            border-left: none;
        }


    </style>
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-body">
                        @if(auth()->id()==$blog->user_id)
                            <div class="text-right">
                                <a href="{{route('blog.edit',$blog)}}" type="button" class="btn btn-link">编辑</a>
                            </div>
                        @endif
                        <h3 class="font-weight-light text-center mb-3">{{$blog->title}}</h3>
                        <div class="text-center fs-14 text-muted">

                            <span class="mr-2">{{$blog->updated_at->diffForHumans()}}</span>

                            <span class="mr-2">{{$blog->view}}</span>

                            <span></span>2
                        </div>
                        <hr>
                        <div class="markdown" id="content">

                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header bg-white fs-14">
                        回复数量
                    </div>
                    <div class="card-body" id="comment-list">
                        @forelse($blog->comments as $comment)
                            <div class="media mb-3 border-bottom pb-3 replay">
                                <img width="50" height="70" src="{{avatar($comment->user->avatar)}}" alt="">
                                <div class="media-body">
                                    <div style="font-size: 8px"
                                         class="mr-3 text-danger ml-3">{{($comment->created_at)->diffForHumans()}}</div>
                                    <div class="mt-0 ml-3"><span
                                            style="color: #0e9f6e;font-size: 20px">评论标题:</span>{{$comment->user->name}}
                                    </div>
                                    <div class="pb-2 ml-3">
                                        <span class="text-success">评论内容:</span>{{$comment->content}}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div id="empty" class="text-center py-3 text-muted">暂无评论...</div>
                        @endforelse
                    </div>
                </div>

                {{--                判断登录--}}
                @auth
                    <div class="card mt-4">
                        <div class="card-body pb-2">
                            <form id="form-comment" action="{{route('blog.comment',$blog)}}">
                                @csrf
                                <div class="form-group">
                                <textarea name="content" class="form-control" id="exampleFormControlTextarea" rows="10"
                                          cols="100"></textarea>
                                </div>
                                <div class="text-right">
                                    <button id="btn-comment" type="button" class="btn btn-primary btn-sm px-5">回复
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card mt-4">
                        <div class="card-body pb-2">
                            <div class="alert alert-warning" role="alert">
                                你还没有登录，请登录
                                <a href="{{route('login')}}" class="btn btn-primary btn-sm py-1 px-4 ml-3">马上登录</a>
                            </div>
                        </div>
                    </div>
                @endauth


            </div>
            <div class="col-sm-3 p-0">
                @include('common.right-card',[
        'imgUrl'=>'https://img.yzcdn.cn/vant/cat.jpeg',
        'title'=>$blog->category->name,
        'content'=>'收录了'.$blog->category->name.'的文章',
        'count'=>$blog->category->blogs()->count(),
        'category_id'=>$blog->category_id
    ])
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{asset('js/showdown.min.js')}}"></script>
    <script src="{{asset('js/showdown-table.js')}}"></script>
    <script>
        function convert() {
            var text = @json($blog->content);
            var converter = new showdown.Converter({extension: ['table']});
            var html = converter.makeHtml(text);
            $('#content').html(html);
            $('#content > table').addClass('table table-bordered');
        }

        convert();
        //Ajax提交评论
        $(function () {
            /**
             * 点击发送评论
             * @type {*|jQuery|HTMLElement}
             */
            $('#btn-comment').click(function () {
                //获取表单
                var form = $('#form-comment');
                //添加评论
                $.ajax({
                    url: form.attr('action'),
                    type: 'post',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (res) {
                        if (res.code === 200) {
                            //评论成功后，无刷新显示到评论列表里面
                            $('#comment-list').append(`
                                <div class="media mb-3 border-bottom pb-3 replay">
                                <img width="50" height="50" src="${res.data.avatar_url}" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0">${res.data.user_name}</h5>
                                    ${res.data.content}
                            </div>
                        </div>
                            `);
                            //清空输入框的内容
                            $('#exampleFormControlTextarea').val('');
                            //在评论了之后，让没有评论的提示隐藏
                            $('#empty').hide();
                            notify('success', res.msg)
                        } else {
                            notify('error', res.msg)
                        }
                    }
                })
            })

        })
    </script>
@endsection
