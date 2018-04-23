<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	const MALE = 1;
	const FEMALE = 2;
	protected $table = "user";


	public function getGender($gender=null)
	{
		$list = [
			[
				'name'=>'男',
				'value'=> self::MALE,
				'default'=>1
			],[
				'name'=>'女',
				'value'=> self::FEMALE,
				'default'=>0
			]
		];
		if(!$gender){
			return $list;
		}

		foreach ($list as $v){
			if($v['value'] == $gender)
				return $v['name'];
		}
	}
}