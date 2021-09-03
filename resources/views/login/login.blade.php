@extends('layout.app')
@section('title','登录')
@section('style')
    <style></style>
@endsection
@section('content')
    <div class="container">
        <div class="row pt-4">
            <div class="card col-lg-4 offset-4 mb-3 mt-5">
                <div class="card-body">
                    @include('login.nav-top',['type'=>'login'])
                    <hr>
                    <x-jet-validation-errors class="mb-4"></x-jet-validation-errors>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail" class="fs-14 font-weight-bold">用户名</label>
                            <input type="email" class="form-control form-control-sm"
                                   id="exampleInputEmail"
                                   placeholder="请填写邮箱"
                                   name="email"
                            >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="fs-14 font-weight-bold">密码</label>
                            <input type="password" class="form-control form-control-sm"
                                   id="exampleInputPassword1"
                                   placeholder="请填写密码"
                                   name="password"
                            >
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary w-100 mt-4">登录</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script></script>
@endsection
