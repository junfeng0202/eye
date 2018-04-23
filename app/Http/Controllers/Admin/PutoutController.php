<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\Putout;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PutoutController extends Controller
{
	public function __construct()
	{
		view()->share('active', 'putout');
	}

	public function index(Request $request)
	{
		$query = Putout::query();
		$kw = $request->kw;
		$date = $request->date;
		if($kw){
			$query->where(function($opt) use ($kw){
				$opt->where('g1.brand','like','%'.$kw.'%')->orWhere('g2.brand','like','%'.$kw.'%')->orWhere('user.phone','like','%'.$kw.'%');
			});
		}
		if($date){
			$time = explode(' ~ ',$date);
			$query->where(function($opt) use ($time){
				$opt->where('putout.created_at','>=',$time[0])->where('putout.created_at','<',date('Y-m-d',strtotime($time[1].' +1 day')));
			});
		}
		$query->leftJoin('goods as g1','g1.id','=','putout.frame_id')
			->leftJoin('goods as g2','g2.id','=','putout.left_glass_id')
			->leftJoin('goods as g3','g3.id','=','putout.right_glass_id')
			->join('user','user.id','=','putout.user_id');
		//dd($query->toSql());
		$query_clone = clone $query;
		$lists = $query->orderBy('putout.id','desc')->paginate(10,['putout.*','g1.brand as frame_brand','g2.brand as left_glass_brand','g3.brand as right_glass_brand','user.name','user.phone','user.gender']);
		$total_sale = $query_clone->sum('putout.price');
		$total_integral = $query_clone->sum('putout.integral_use');
		$total_cost = $query_clone->sum('putout.cost');
		$total_profit = $query_clone->sum('putout.profit');
		$lists->appends(['kw'=>$kw,'date'=>$date]);
		$request->flash();
		return view('admin.putout.index', compact('lists','total_sale','total_integral','total_cost','total_profit'));
	}

	public function edit(Request $request)
	{
		$id = $request->id;
		if($id) $info = Putout::find($id);
		else $info = new Putout();
		if($request->isMethod('post')){
			try{
				DB::beginTransaction();
				$data = array_filter($request->all(),function ($v){
					return $v!==null;
				});
				if(!$id){
					$count = Putout::whereDate('created_at',date('Y-m-d'))->count();
					$data['number'] = sprintf(date('Ymd').'%04s',++$count);
				}
				$data['profit'] = bcsub(bcsub($data['price'],$data['integral_use'],2) ,$data['cost'],2);
				Putout::updateOrCreate(['id'=>$id],$data);
				//出库数量
				if($id){
					$stock = $request->frame_num - $info->frame_num;
					$left_stock = $request->left_glass_num - $info->left_glass_num;
					$right_stock = $request->right_glass_num - $info->right_glass_num;
				}else{
					$stock = $request->frame_num;
					$left_stock = $request->left_glass_num;
					$right_stock = $request->right_glass_num;
				}
				if($data['frame_id']){
					$goodsFrame = Goods::find($data['frame_id']);
					$goodsFrame->stock -= $stock;
					$goodsFrame->save();
				}
				if($data['left_glass_id']){
					$goodsGlass = Goods::find($data['left_glass_id']);
					$goodsGlass->stock -= $left_stock;
					$goodsGlass->save();
				}
				if($data['right_glass_id']){
					$goodsGlass = Goods::find($data['right_glass_id']);
					$goodsGlass->stock -= $right_stock;
					$goodsGlass->save();
				}
				//用户积分增加
				$user= User::find($data['user_id']);
				if($user->integral < $data['integral_use']){
					throw new \Exception('顾客积分不足，剩余积分:'.$user->integral);
				}
				if($id){
					$integral = ($data['price'] - $data['integral_use'])/Putout::PER  - ($info['price'] - $info['integral_use'])/Putout::PER - ($data['integral_use']- $info['integral_use']);
				}else{
					$integral = ($data['price'] - $data['integral_use'])/Putout::PER -$data['integral_use'];
				}
				$user->integral += intval($integral);
				$user->save();
				DB::commit();
				return response()->json(['code'=>200,'msg'=>'操作成功','data'=>['url'=>'/putout']]);
			}catch (\Exception $e){
				DB::rollBack();
				return response()->json(['code'=>500,'msg'=> $e->getMessage(),'data'=>[]]);

			}
		}
		$users = User::orderBy('id','desc')->limit(10)->get();
		$frame = Goods::where(['type'=>Goods::FRAME])->where('stock','>',0)->get();
		$glass = Goods::where('type',Goods::GLASS)->where('stock','>',0)->get();
		return view('admin.putout.edit', compact('info','frame','glass','users'));
	}
}