@extends('layout.app')
@section('title','修改个人信息')
@section('style')
    <style></style>
@endsection
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-3">
                @include('common.user-menu',['nav'=>'info'])
            </div>
            <div class="col-sm-9 p-0">
                <div class="card">
                    <div class="card-header bg-white fs-14">
                        修改个人信息
                    </div>
                    <div class="card-body">
                        @include('common.warning')
                        @include('common.success')
                        <form method="post" action="{{ route('user.info.update') }}" class="col-md-6 offset-3">
                        @csrf
                        @method('put')<!--伪造put请求-->
                            <div class="form-group">
                                <label for="exampleInputName" class="fs-14 font-weight-bold">用户名</label>
                                <input type="text" value="{{auth()->user()->name}}" placeholder="请填写用户名"
                                       class="@error('name') is-invalid @enderror form-control form-control-sm"
                                       id="exampleInputName"
                                       aria-describedby="emailHelp" name="name">
                                @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleEmail" class="fs-14 font-weight-bold">邮箱</label>
                                <input type="email" value="{{auth()->user()->email}}" placeholder="请填写邮箱"
                                       class="@error('email') is-invalid @enderror form-control form-control-sm"
                                       id="exampleInputName"
                                       aria-describedby="emailHelp" name="email">
                                @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary btn-sm w-100 mt-3">修改</button>
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
