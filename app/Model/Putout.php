<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Putout extends Model
{
	const THRID = 1;
	const CASH = 2;
	const CARD = 3;
	const MT = 4;
	const NM = 5;
	const DZ = 6;


	const PER = 10; //积分使用比例
	protected $table = "putout";

	protected $fillable = ['number', 'user_id', 'frame_id', 'frame_type',  'frame_num', 'left_glass_id', 'left_glass_type', 'left_glass_num', 'right_glass_id', 'right_glass_type', 'right_glass_num', 'left_eye', 'right_eye', 'pd', 'price', 'cost', 'integral_use', 'pay_type', 'code', 'profit'];

	public static function getPayType($type = null)
	{
		$list = [
			self::THRID => '支付宝/微信',
			self::CASH => '现金',
			self::CARD => '刷卡',
			self::MT => '美团',
			self::NM => '糯米',
			self::DZ => '大众',
		];
		if ($type) {
			return array_key_exists($type, $list) ? $list[$type] : '未知';
		}
		return $list;
	}
}