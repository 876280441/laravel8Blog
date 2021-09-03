@extends('layout.app')
@section('title','修改头像')
@section('style')
    <style></style>
@endsection
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-3">
                @include('common.user-menu',['nav'=>'avatar'])
            </div>
            <div class="col-sm-9 p-0">
                <div class="card">
                    <div class="card-header bg-white fs-14">
                        修改头像
                    </div>
                    <div class="card-body">
                        @include('common.error')
                        @include('common.success')
                        <form method="post" enctype="multipart/form-data" action="{{route('user.avatar.update')}}"
                              class="col-md-6 offset-3">
                        @csrf
                        @method('PUT')<!--模拟表单-->
                            <div class="form-group">
                                <label for="exampleFormControlFile1">请选择头像上传</label>
                                <input type="file" name="avatar" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <button type="submit"
                                    class="btn btn-danger btn-sm w-100 mt-4 bg-blue text-white text-danger">修改
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script></script>
@endsection
