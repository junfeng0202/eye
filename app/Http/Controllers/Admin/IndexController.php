<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IndexController extends Controller{
	public function __construct()
	{
		view()->share('active','index');
	}

	public function index(){
		return view('admin.dashboard.index',[
			
		]);
	}
}