<?php namespace App\Controllers;

class Pizza extends BaseController
{
	public function index()
	{
		return view('auths/login');
	}

	public function viewsPizza()
	{
		return view('index');
	}
	public function signinAccount()
	{
		return view('auths/register');
	}
	//--------------------------------------------------------------------

}
