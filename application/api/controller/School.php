<?php
namespace app\api\controller;

class School extends Base
{
    public function index()
    {
		$user = db('users')->select();
		return view();
    }
}
