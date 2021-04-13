<?php

namespace App\Controllers;

use App\Models\User as ModelsUser;

class User extends BaseController
{
	public function index()
	{
		$user = new ModelsUser();
		$users = $user->findAll();
		$final_users = array();

		foreach ($users as $single_user) {
			unset($single_user['password']);
			array_push($final_users, $single_user);
		}

		$this->view_data(
			array(
				'title' => 'المستخدمين',
				'users' => $final_users,
			)
		);
		echo view('templates/header', $this->view_data);
		echo view('users', $this->view_data);
		echo view('templates/footer', $this->view_data);
	}

	public function new()
	{
		$this->view_data(
			array(
				'title' => 'إضافة مستخدم',
			)
		);
		echo view('templates/header', $this->view_data);
		echo view('newUser', $this->view_data);
		echo view('templates/footer', $this->view_data);
	}

	public function create()
	{
		$this->view_data(
			array(
				'title' => 'إضافة مستخدم',
			)
		);
		if ($this->request->getMethod() === 'post') {
			//let's do the validation here
			$rules = [
				'username' => 'required|min_length[6]|max_length[50]|is_unique[users.username]',
				'password' => 'required|min_length[8]|max_length[255]',
				'passwordconfirm' => 'matches[password]',
				'display_name' => 'required|min_length[5]|max_length[100]',
				'is_admin' => 'required',
			];

			$errors = array(
				'username' => array(
					'required' => 'يجب إدخال إسم المستخدم',
					'min_length' => 'يجب أن لا يقل إسم المستخدم عن 6 أحرف',
					'max_length' => 'يجب أن لا يزيد إسم المستخدم عن خمسون حرف',
					'is_unique' => 'إسم المستخدم موجود في قاعدة البيانات'
				),
				'password' => array(
					'required' => 'يجب إدخال كلمة المرور',
					'min_length' => 'يجب أن لا تقل كلمة المرور عن 8 أحرف',
					'max_length' => 'يجب أن لا تزيد كلمة المرور عن 255 حرف'
				),
				'passwordconfirm' => array(
					'matches' => 'كلمة المرور غير مطابقة'
				),
				'display_name' => array(
					'required' => 'يجب إدخال الإسم الكامل',
					'min_length' => 'يجب أن لا يقل الإسم الكامل عن 5 أحرف',
					'max_length' => 'يجب أن لا زيد الإسم الكامل عن 100 حرف'
				),
				'is_admin' => array(
					'required' => 'يجب إختيار الدور'
				),
			);

			if (!$this->validate($rules, $errors)) {
				$this->view_data(
					array(
						'validation' => $this->validator,
					),
					true
				);
			} else {
				$model = new ModelsUser();

				$newData = [
					'username' => $this->request->getVar('username'),
					'password' => $this->request->getVar('password'),
					'display_name' => $this->request->getVar('display_name'),
					'is_admin' => $this->request->getVar('is_admin')
				];
				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'تم إضافة المستخدم بنجاح!'); // setup at view
				return redirect()->to('/users');
			}
		}

		echo view('templates/header', $this->view_data);
		echo view('newUser', $this->view_data);
		echo view('templates/footer', $this->view_data);
	}

	public function edit()
	{

		$users = new ModelsUser();
		$user_id = $this->request->getVar('user_id');
		if (!$user_id) {
			return 'Bad Request!';
		}

		$user = $users->find($user_id);

		if (empty($user)) {
			return 'Bad Request!';
		}

		$this->view_data(
			array(
				'title' => 'تحديث مستخدم',
				'user' => $user
			)
		);
		echo view('templates/header', $this->view_data);
		echo view('editUser', $this->view_data);
		echo view('templates/footer', $this->view_data);
	}

	public function update()
	{
		

		$users = new ModelsUser();
		$user_id = $this->request->getVar('id');
		if (!$user_id) {
			return 'Bad Request!';
		}

		$user = $users->find($user_id);

		if (empty($user)) {
			return 'Bad Request!';
		}

		$this->view_data(
			array(
				'title' => 'تحديث مستخدم'
			)
		);

		if ($this->request->getMethod() === 'post') {
			//let's do the validation here
			$rules = [
				'username' => 'required|min_length[6]|max_length[50]',
				'password' => 'max_length[255]',
				'passwordconfirm' => 'matches[password]',
				'display_name' => 'required|min_length[5]|max_length[100]',
				'is_admin' => 'required',
			];

			$errors = array(
				'username' => array(
					'required' => 'يجب إدخال إسم المستخدم',
					'min_length' => 'يجب أن لا يقل إسم المستخدم عن 6 أحرف',
					'max_length' => 'يجب أن لا يزيد إسم المستخدم عن خمسون حرف',
					'is_unique' => 'إسم المستخدم موجود في قاعدة البيانات'
				),
				'password' => array(
					'min_length' => 'يجب أن لا تقل كلمة المرور عن 8 أحرف',
					'max_length' => 'يجب أن لا تزيد كلمة المرور عن 255 حرف'
				),
				'passwordconfirm' => array(
					'matches' => 'كلمة المرور غير مطابقة'
				),
				'display_name' => array(
					'required' => 'يجب إدخال الإسم الكامل',
					'min_length' => 'يجب أن لا يقل الإسم الكامل عن 5 أحرف',
					'max_length' => 'يجب أن لا زيد الإسم الكامل عن 100 حرف'
				),
				'is_admin' => array(
					'required' => 'يجب إختيار الدور'
				),
			);

			if (!$this->validate($rules, $errors)) {
				$this->view_data(
					array(
						'validation' => $this->validator,
					),
					true
				);
			} else {

				$newData = [
					'username' => $this->request->getVar('username'),
					'password' => $this->request->getVar('password'),
					'display_name' => $this->request->getVar('display_name'),
					'is_admin' => $this->request->getVar('is_admin')
				];
				$users->update($user_id, $newData);
				$session = session();
				$session->setFlashdata('success', 'تم تحديث المستخدم بنجاح!'); // setup at view
				return redirect()->to('/users');
			}
		}
		$this->view_data(
			array(
				'user' => $user
			),
			true
		);
		


		echo view('templates/header', $this->view_data);
		echo view('editUser', $this->view_data);
		echo view('templates/footer', $this->view_data);
	}
}
