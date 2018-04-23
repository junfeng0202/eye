<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function __construct()
	{
		view()->share('active', 'user');
	}

	public function index(Request $request)
	{
		$user = User::query();
		$phone = $request->phone;
		if ($phone) {
			$user->where('phone', 'like', '%' . $phone . '%');
		}
		$users = $user->paginate(10);
		$users->appends(['phone' => $phone]);
//		dd($users);
		$request->flash();
		return view('admin.user.index', compact('users'));
	}

	public function edit(Request $request)
	{
		$id = $request->id;
		if ($id) $user = User::find($id);
		else $user = new User();
		if ($request->isMethod('post')) {
			$phone = $request->phone;
			if ($user->phone!=$phone && User::wherePhone($phone)->exists()) {
				return response()->json(['code' => 500, 'msg' => '手机号已被使用', 'data' => []]);
			}
			$user->name = $request->name;
			$user->gender = $request->gender;
			$user->phone = $request->phone;
			$user->integral = $request->integral ?? 0;
			if ($user->save()) {
				return response()->json(['code' => 200, 'msg' => '操作成功', 'data' => ['url' => '/user']]);
			} else {
				return response()->json(['code' => 500, 'msg' => '操作失败', 'data' => []]);
			}
		}
		return view('admin.user.edit', compact('user'));
	}


	public function getUser(Request $request)
	{
		$user = User::where('phone', 'like', '%' . $request->phone . '%')->limit(20)->select(['id','phone','name'])->get()->toArray();
		return response()->json($user);
	}
}