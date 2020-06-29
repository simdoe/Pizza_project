<?php namespace App\Controllers;

class Pizza extends BaseController
{
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
