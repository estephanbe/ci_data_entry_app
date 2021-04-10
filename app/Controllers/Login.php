<?php

namespace App\Controllers;

use App\Models\User;


class Login extends BaseController
{
	public function __construct()
	{
		$this->title = 'صفحة الدخول';
	}

	public function index()
	{
		$this->view_data(
			array(
				'title' => 'صفحة الدخول'
			)
		);
		echo view('templates/header', $this->view_data);
		echo view('login', $this->view_data);
		echo view('templates/footer', $this->view_data);
	}

	public function authenticate()
	{
		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'username' => 'required|min_length[6]|max_length[50]',
				'password' => 'required|min_length[8]|max_length[255]|validateUser[username,password]',
			];

			$errors = [
				'password' => [
					'validateUser' => 'إسم مستخدم أو كلمة مرور غير صحيحة'
				]
			];

			if (!$this->validate($rules, $errors)) {
				$this->view_data(array(
					'validation' => $this->validator
				), true);
			} else {
				$model = new User();

				$user = $model->where('username', $this->request->getVar('username'))
					->first();

				$this->setUserSession($user);
				return redirect()->to('/');
			}
		}

		echo view('templates/header', $this->view_data);
		echo view('login', $this->view_data);
		echo view('templates/footer', $this->view_data);
	}

	public function logout(){
		session()->destroy();
		return redirect()->to('/login');
	}

	private function setUserSession($user)
	{
		$data = [
			'id' => $user['id'],
			'username' => $user['username'],
			'display_name' => $user['display_name'],
			'is_admin' => $user['is_admin'],
			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}
	
}
