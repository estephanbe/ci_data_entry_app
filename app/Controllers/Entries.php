<?php

namespace App\Controllers;

use App\Models\Entry;
use CodeIgniter\Exceptions\PageNotFoundException;
use PHPUnit\Util\Json;

class Entries extends BaseController
{
	public function index()
	{
		$entries = new Entry();
		$entries_count = $entries->where('soft_delete', 0)->countAllResults(false);

		$entries_reslut = $entries->where('soft_delete', 0);
		$all_entries = $entries_reslut->findAll();

		if (!$this->request->getVar('page') && !$this->request->getVar('per_page')) {
			$all_entries =  array_splice($all_entries, 0, 10);
		} else {
			$all_entries =  $this->get_entries_by_page($entries_reslut->findAll());
		}


		$this->view_data(
			array(
				'title' => 'الرئيسية',
				'entries' => $all_entries,
				'entries_count' => $entries_count
			)
		);
		echo view('templates/header', $this->view_data);
		echo view('Entries/index', $this->view_data);
		echo view('templates/footer', $this->view_data);
	}

	public function show(int $id)
	{
		$entry = new Entry();
		$the_entry = array();
		

		if (! $the_entry = $entry->find($id)){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		} elseif ($the_entry['soft_delete']){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$this->view_data(array(
			'title' => 'عرض المتعاون',
			'entry' => array(
				"id" => $the_entry['id'],
				"name" => $the_entry['name'],
				"country" => $the_entry['country'],
				"nationality" => $the_entry['nationality'],
				"occupation" => $the_entry['occupation'],
				"photo_url" => $the_entry['photo_url'],
			)
		));
		echo view('templates/header', $this->view_data);
		echo view('Entries/show', $this->view_data);
		echo view('templates/footer', $this->view_data);
	}

	public function new()
	{
		$this->view_data(array(
			'title' => 'إضافة متعاون',
		));
		echo view('templates/header', $this->view_data);
		echo view('Entries/new', $this->view_data);
		echo view('templates/footer', $this->view_data);
	}

	public function create()
	{
		if ($this->request->getMethod() !== 'post') {
			return redirect()->to('entries/new');
		}

		$rules = array(
			'name' => 'required|min_length[3]|max_length[50]|is_unique[entries.name]',
			'country' => 'max_length[50]',
			'nationality' => 'max_length[50]',
			'occupation' => 'max_length[50]',
		);

		$errors = array(
			'name' => array(
				'required' => 'يجب أن تدخل الإسم!',
				'is_unique' => 'هذا الإسم موجود، تحقق من المتعاونيين!'
			)
		);

		if ($this->validate($rules, $errors)) {
			$model = new Entry();

			$newData = [
				'name' => $this->request->getVar('name'),
				'country' => $this->request->getVar('country'),
				'nationality' => $this->request->getVar('nationality'),
				'occupation' => $this->request->getVar('occupation'),
				'photo_url' => $this->request->getVar('photo_url'),
			];
			$model->save($newData);
			session()->setFlashdata('success', 'تم إضافة المتعاون بنجاح!');
			return redirect()->to('/entries/new');
		}

		$this->view_data(array(
			'title' => 'إضافة متعاون',
			'validation' => $this->validator
		));
		echo view('templates/header', $this->view_data);
		echo view('Entries/new', $this->view_data);
		echo view('templates/footer', $this->view_data);
	}

	public function edit(int $id)
	{
		$entry = new Entry();
		$the_entry = array();
		

		if (! $the_entry = $entry->find($id)){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		} elseif ($the_entry['soft_delete']){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$this->view_data(array(
			'title' => 'عرض المتعاون',
			'entry' => array(
				"id" => $the_entry['id'],
				"name" => $the_entry['name'],
				"country" => $the_entry['country'],
				"nationality" => $the_entry['nationality'],
				"occupation" => $the_entry['occupation'],
				"photo_url" => $the_entry['photo_url'],
			)
		));

		$this->view_data(array(
			'title' => 'تحديث متعاون',
			'entry' => array(
				"id" => $the_entry['id'],
				"name" => $the_entry['name'],
				"country" => $the_entry['country'],
				"nationality" => $the_entry['nationality'],
				"occupation" => $the_entry['occupation'],
				"photo_url" => $the_entry['photo_url'],
			)
		));
		echo view('templates/header', $this->view_data);
		echo view('Entries/edit', $this->view_data);
		echo view('templates/footer', $this->view_data);
	}

	public function update($id)
	{
		
		
		if ($this->request->getMethod() !== 'put' && ! $this->request->isAJAX()) {
			return redirect()->to('entries/new');
		}

		$rules = array(
			'name' => 'required|min_length[3]|max_length[50]|is_unique[entries.name]',
			'country' => 'max_length[50]',
			'nationality' => 'max_length[50]',
			'occupation' => 'max_length[50]',
		);

		$errors = array(
			'name' => array(
				'required' => 'يجب أن تدخل الإسم!',
				'is_unique' => 'هذا الإسم موجود، تحقق من المتعاونيين!'
			)
		);

		if ($this->validate($rules, $errors)) {
			$model = new Entry();

			$the_entry = $this->request->getRawInput();

			return json_encode($the_entry);

			$newData = [
				'name' => $the_entry['name'],
				'country' => $the_entry['country'],
				'nationality' => $the_entry['nationality'],
				'occupation' => $the_entry['occupation'],
				'photo_url' => $the_entry['photo_url'],
			];
			$model->update($id, $newData);
			return true;
		}

		return false;
	}

	public function delete($id)
	{
		$model = new Entry();
		$model->update($id, array('soft_delete' => 1));

		return true;
	}

	private function get_entries_by_page($entries)
	{
		if ($this->request->getVar('per_page') === 'all') {
			return $entries;
		}
		$page = $this->request->getVar('page');
		$page = empty($page) ? 1 : (int) $page;

		$per_page = $this->request->getVar('per_page'); // if per_page is empty, then it is the default per page which is 10.
		$per_page = empty($per_page) ? 10 : (int) $per_page;



		return array_splice($entries, ($page - 1) * $per_page, $page * $per_page);
	}
}
