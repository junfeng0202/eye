<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\Putout;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaticController extends Controller
{
	public function __construct()
	{
		view()->share('active', 'static');
	}

	public function index(Request $request)
	{
		$date = $request->get('date');
		$opt = '';
		if ($date) {
			$time = explode(' ~ ', $date);
			$start = $time[0];
			$end = date('Y-m-d', strtotime($time[0] . ' +1 day'));
			$opt = "where created_at >= '{$start}' and created_at < '{$end}' ";
		}
		//统计镜片销量
		$sql = 'select u.total as y,goods.brand as name from ( SELECT glass_id,sum(num) as total FROM ' .
			'(select right_glass_id as glass_id,sum(right_glass_num) as num FROM putout ' . $opt . ' GROUP BY right_glass_id ' .
			'UNION ALL ' .
			'select left_glass_id as glass_id,sum(left_glass_num) as num FROM putout ' . $opt . ' GROUP BY left_glass_id ' .
			') as g ' .
			'GROUP BY glass_id ) as u ' .
			'join goods on goods.id = u.glass_id';

		$data = DB::select($sql);
		// dd($data);
		foreach ($data as &$v) {
			$v->y = (int)$v->y;
		}

		// 统计镜框销量
		$sql2 = 'select p.y,goods.brand as name from (select frame_id,sum(frame_num) as y from putout ' . $opt . 'group by frame_id) as p JOIN goods on goods.id = p.frame_id';
		$data_frame = DB::select($sql2);
		foreach ($data_frame as &$val) {
			$val->y = (int)$val->y;
		}

		$request->flash();
		return view('admin.static.index', ['active_child' => 'staticIndex', 'data' => json_encode($data), 'data_frame' => json_encode($data_frame), 'date' => $date]);
	}


	public function profit(Request $request)
	{

		/*$date1 = new \DateTime();
		$date2 = new \DateTime('2016-12-15');

		$diff = $date1->diff($date2);
		print_r($diff);
		die;*/
		if($request->ajax()){

			$type = $request->type ?? 'Y-m';
			$value = $request->date ?? date($type);
			$date_x = [];
			$rangeDate = [];
			$inverted = true;
			$whereType = '';
			if ($type == 'Y-m') {
				$dateIime = new \DateTime($value);
				$dateNum = date('t', $dateIime->getTimestamp());//dd($dateNum);
				$dateInterval = \DateInterval::createFromDateString('+1 day');
				$datePeriod = new \DatePeriod($dateIime, $dateInterval, $dateNum - 1);
				$dateYear = $dateIime->format('Y');
				foreach ($datePeriod as $date) {
					$date_x[] = $date->format('n-j');
					$rangeDate[] = $date->format('Y-m-d');
				}

				//统计条件
				$whereType = 'whereDate';
			} else {
				$dateIime = new \DateTime($value . '-01');
				$dateInterval = \DateInterval::createFromDateString('+1 month');
				$datePeriod = new \DatePeriod($dateIime, $dateInterval, 11);
				$dateYear = $dateIime->format('Y');
				foreach ($datePeriod as $date) {
					$date_x[] = $date->format('n月');
					// $rangeDate[] = [$date->format('Y-m-d'), $date->add(new \dateInterval('P1M'))->format('Y-m-d')];
					$rangeDate[] = $date->format('m');
				}
				//坐标轴是否反转
				$inverted = false;
				//统计条件
				$whereType = 'whereMonth';
				//print_r($date_x);
			}
//			dd($rangeDate);
			$price = [];//销售额
			$profit = [];//利润
			foreach ($rangeDate as $range) {
				$price[] = (int)Putout::$whereType('created_at',$range)->whereYear('created_at',$dateYear)->sum('price');
				$profit[] = (int)Putout::$whereType('created_at',$range)->whereYear('created_at',$dateYear)->sum('profit');
			}
			//dd($price);
			return response()->json(['date_x'=>$date_x,'price'=>$price,'profit'=>$profit,'inverted'=>$inverted]);
		}
		return view('admin.static.profit', ['active_child' => 'profit']);
	}

}