<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Putin extends Model
{
	protected $table = "putin";

	protected $fillable = ['goods_id','num'];
}