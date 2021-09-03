<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /*
     * 个人信息页面
     *
     */
    public function infoPage()
    {
        return view('user.info');
    }

    /*
     * 个人信息-执行修改
     */
    public function infoUpdate(UserRequest $request)
    {
        $uid = auth()->user()->id;//获取当前登录用户的id
        $name = $request->input('name');
        $email = $request->input('email');
        //更新用户数据
        $res = DB::table('users')->where('id', '=', $uid)
            ->update(['name' => $name, 'email' => $email]);
        if ($res) {
            return back()->with('success', '修改成功');
        } else {
            return back()->with('warning', '未做更改');
        }
    }

    /*
     * 个人中心-更换头像-页面
     */
    public function avatarPage()
    {
        return view('user.avatar');
    }

    /*
     * 个人中心-更换头像-页面
     */
    public function avatarUpdate(Request $request)
    {
        //验证
        $validateData = $request->validate([
            'avatar' => 'required|image'
        ], [
            'avatar.required' => '请选择图片',
            'avatar.image' => '图片格式不符'
        ]);
        $file = $request->file('avatar');//获取上传文件
        //指定磁盘使用public（由于只有public是对外访问的）
        $path = $file->store('avatar', 'public');
        //在更新之前获取用户原来的头像
        $oldAvatar = auth()->user()->avatar;
        //更新当前登录用户的头像
        $uid = auth()->id();//当前登录id
        $res = DB::table('users')
            ->where('id', '=', $uid)
            ->update(['avatar' => $path]);
        if ($res) {
            //用户更新头像之前，删除用户原有的头像
            Storage::disk('public')->delete($oldAvatar);
            return back()->with(['success' => '头像更新成功']);
        } else {
            return back()->withErrors('头像未更新');

        }
    }

    /*
     * 个人中心-我的所有博客
     */
    public function blog()
    {
        //查询用户所有博客
        $blogs = auth()->user()->blogs()
            ->withCount('comments')
            ->OrderBy('updated_at', 'desc')
            ->paginate(7);
        return view('user.blog', ['blogs' => $blogs]);
    }
}
