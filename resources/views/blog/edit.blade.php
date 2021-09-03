@extends('layout.app')
@section('title','编辑博客')
@section('style')
    <style></style>
@endsection
@section('content')
    <div class="container">
        <div class="card mb-3 mt-4">
            <div class="card-body">
                @include('common.success')
                @include('common.error')
                <form action="{{route('blog.update',['blog'=>$blog->id])}}" method="post">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">标题</label>
                        <input type="text" name="title" class="form-control" value="{{$blog->title}}"
                               id="exampleFormControlInput1">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">分类</label>
                        <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                            <option value="">请选择分类</option>
                            @foreach(categories() as $id=>$name)
                                <option {{$blog->category_id==$id?'selected':''}} value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">内容</label>
                        <textarea class="form-control" name="content" id="exampleFormControlTextarea1" cols="30"
                                  rows="10">
                            {{$blog->content}}
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-25 offset-4">发布</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
