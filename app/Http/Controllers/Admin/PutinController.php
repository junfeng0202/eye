<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\Putin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PutinController extends Controller
{
	public function __construct()
	{
		view()->share('active', 'putin');
	}

	public function index(Request $request)
	{
		$query = Putin::query();
		$kw = $request->kw;
		$type = $request->type;
		if($kw){
			$query->where('goods.brand','like','%'.$kw.'%');
		}
		if($type){
			$query->where('goods.type',$type);
		}
		$query->join('goods','goods.id','=','putin.goods_id');
		$query_clone = clone $query;
		$lists = $query->orderBy('id','desc')->paginate(10,['putin.*','goods.brand','goods.type']);
		$total = $query_clone->sum('num');
		$lists->appends(['kw'=>$kw]);
		$request->flash();
		return view('admin.putin.index', compact('lists','total'));
	}

	public function edit(Request $request)
	{
		$id = $request->id;
		if($id) $info = Putin::find($id);
		else $info = new Putin();
		if($request->isMethod('post')){
			try{
				DB::beginTransaction();
				Putin::updateOrCreate(['id'=>$id],$request->all());
				if($id){
					$stock = $request->num - $info->num;
				}else{
					$stock = $request->num;
				}
				$goodsModel = Goods::find($request->goods_id);
				$goodsModel->stock += $stock;
				$goodsModel->save();
				DB::commit();
				return response()->json(['code'=>200,'msg'=>'操作成功','data'=>['url'=>'/putin']]);
			}catch (\Exception $e){
				DB::rollBack();
				return response()->json(['code'=>500,'msg'=> $e->getMessage(),'data'=>[]]);

			}
		}

		$goods_frame = Goods::where('type',Goods::FRAME)->get();
		$goods_glass = Goods::where('type',Goods::GLASS)->get();
		return view('admin.putin.edit', compact('info','goods_frame','goods_glass'));
	}
}