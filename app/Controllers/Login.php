<?php

namespace App\Controllers;

class Login extends BaseController
{
	public function __construct()
	{
		$this->title = 'صفحة الدخول';
	}

	public function index()
	{
		echo view('templates/header', $this->view_data);
		echo view('login', $this->view_data);
		echo view('templates/footer', $this->view_data);
	}

	public function authenticate()
	{
		var_dump($this->request->getMethod());
	}
}
