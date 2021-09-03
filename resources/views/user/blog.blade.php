@extends('layout.app')
@section('title','所有博客')
@section('style')
    <style>
        .blog-list:last-child {
            border-bottom: none !important;
        }
    </style>
@endsection
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-3">
                @include('common.user-menu',['nav'=>'blog'])
            </div>
            <div class="col-sm-9 p-0">
                <div class="card">
                    <div class="card-header bg-white fs-14">
                        所有博客
                        <a href="{{route('blog.create')}}" style="padding-left: 670px">发布博客</a>
                    </div>
                    <div class="card-body">
                        @foreach($blogs as $v)
                            <div class="blog-list border-bottom pb-3 mb-3 blog-item">
                                <div><a href="{{route('blog.show',$v)}}"
                                        class="text-dark text-decoration-none">{{$v->title}}</a></div>
                                <div class="mt-2 d-flex justify-content-between">
                                    <div class="fs-14 text-muted">
                                        <span class="mr-2">{{($v->updated_at)->diffForHumans()}}</span>
                                        <span class="mr-2">{{$v->view}}</span>
                                        <span></span>{{$v->comments_count}}
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="custom-control custom-switch mr-3">
                                            <input
                                                {{$v->status == 1?'checked':''}} data-url="{{route('blog.status',$v)}}"
                                                type="checkbox" class="status-blog custom-control-input"
                                                id="status-{{$v->id}}">
                                            <label class="custom-control-label text-muted" style="font-size: 14px"
                                                   for="status-{{$v->id}}">是否显示</label>
                                        </div>
                                        <a href="{{route('blog.edit',$v)}}"
                                           class="btn btn-sm py-0 px-3 btn-primary">编辑</a>
                                        <a href="javascript:;" data-url="{{route('blog.destroy',$v)}}"
                                           class="del-blog btn btn-sm py-0 px-3 btn-danger">删除</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{$blogs->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            /**
             * Ajax删除博客
             */
            $('.del-blog').click(function () {
                var r = confirm('是否确认删除?');
                if (r) {
                    var that = this;
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'delete',
                        dataType: 'json',
                        success: function (res) {
                            if (res.code == 200) {
                                //让删除的这条无刷新消失
                                $(that).parents('.blog-item').remove()
                                notify('success', res.msg)
                            } else {
                                notify('error', res.msg)
                            }
                        }
                    })
                } else {

                }
            })

            /**
             * 改变博客状态
             */
            $('.status-blog').change(function () {
                $.ajax({
                    url: $(this).data('url'),
                    type: 'patch',
                    dataType: 'json',
                    success: function (res) {
                        if (res.code == 200) {
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
