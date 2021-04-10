<?php

namespace App\Controllers;

class User extends BaseController
{
	public function index()
	{
		$this->view_data(
			array(
				'title' => 'المستخدمين',
				'users' => array(
					[
						"id" => 1,
						"username" => "admin",
						"password" => "pass123",
						"display_name" => "مدير الموقع",
					],
					[
						"id" => 2,
						"username" => "user",
						"password" => "pass123",
						"display_name" => "مشاهد",
					],
				)
			)
		);
		echo view('templates/header', $this->view_data);
		echo view('users', $this->view_data);
		echo view('templates/footer', $this->view_data);
	}
}
