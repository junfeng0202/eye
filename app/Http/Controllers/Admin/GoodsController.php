<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Goods;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
	public function __construct()
	{
		view()->share('active', 'goods');
	}

	public function index(Request $request)
	{
		$query = Goods::query();
		$kw = $request->kw;
		if($kw){
			$query->where('brand','like','%'.$kw.'%');
		}
		$lists = $query->orderBy('stock')->paginate(10);
		//$lists->appends(['phone'=>$phone]);
//		dd($users);
		$request->flash();
		return view('admin.goods.index', compact('lists'));
	}

	public function edit(Request $request)
	{
		$id = $request->id;

		if($request->isMethod('post')){

			$res = Goods::updateOrCreate(['id'=>$id],$request->all());
			if($res){
				return response()->json(['code'=>200,'msg'=>'操作成功','data'=>['url'=>'/goods']]);
			}else{
				return response()->json(['code'=>500,'msg'=>'操作失败','data'=>[]]);
			}
		}
		if($id) $info = Goods::find($id);
		else $info = new Goods();
		return view('admin.goods.edit', compact('info'));
	}
}