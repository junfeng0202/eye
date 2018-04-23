<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
	const FRAME = 1;
	const GLASS = 2;

	const INIT = 1; //默认选中

	protected $table = "goods";

	protected $fillable = ['brand','type','price'];


	public static function getType($type = null){
		$list = [
			self::FRAME => '镜框',
			self::GLASS => '镜片'
		];
		if($type !==null){
			return array_key_exists($type,$list)?$list[$type]:'未知';
		}
		return $list;
	}
}