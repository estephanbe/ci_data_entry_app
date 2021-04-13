<?php

namespace App\Controllers;

use App\Models\Entry;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Exceptions\PageNotFoundException;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Entries extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		$entries = new Entry();

		$entries_count = $entries->where('soft_delete', 0)->countAllResults(false);

		$is_search = false;
		$search_filter = $this->request->getVar('search_filter');
		$search_term = $this->request->getVar('search_term');

		if ($search_filter && $search_term) {
			$is_search = true;
			$all_entries = $entries
				->like($search_filter, $search_term)
				->having('soft_delete = 0')
				->findAll();
		} else {
			$all_entries = $entries->where('soft_delete', 0)->findAll();
			if (!$this->request->getVar('page') && !$this->request->getVar('per_page')) {
				$all_entries =  array_splice($all_entries, 0, 10);
			} else {
				$all_entries =  $this->get_entries_by_page($all_entries);
			}
		}

		$this->view_data(
			array(
				'title' => 'الرئيسية',
				'entries' => $all_entries,
				'entries_count' => $entries_count,
				'is_search' => $is_search
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


		if (!$the_entry = $entry->find($id)) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		} elseif ($the_entry['soft_delete']) {
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


			$file = $this->request->getFile('photo_url');
			$file_path = '';
			if ($file->isValid()) {
				$newName = $file->getRandomName();
				$file->store('../../public/uploads/', $newName);
				$file_path = base_url() . '/uploads/' . $newName;
			}

			$model = new Entry();

			$newData = [
				'name' => $this->request->getVar('name'),
				'country' => $this->request->getVar('country'),
				'nationality' => $this->request->getVar('nationality'),
				'occupation' => $this->request->getVar('occupation'),
				'photo_url' => $file_path,
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


		if (!$the_entry = $entry->find($id)) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		} elseif ($the_entry['soft_delete']) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

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

	public function update_entry($id)
	{

		if ($this->request->getMethod() !== 'post') {
			return redirect()->to('entries/new');
		}

		$model = new Entry();

		$rules = array(
			'name' => 'required|min_length[3]|max_length[50]',
			'country' => 'max_length[50]',
			'nationality' => 'max_length[50]',
			'occupation' => 'max_length[50]',
		);

		$errors = array(
			'name' => array(
				'required' => 'يجب أن تدخل الإسم!',
			)
		);

		if ($this->validate($rules, $errors)) {

			$original_entry = $model->find($id);

			$file = $this->request->getFile('photo_url');
			$file_path = '';
			if ($file->isValid()) {
				$newName = $file->getRandomName();
				$file->store('../../public/uploads/', $newName);
				$file_path = base_url() . '/uploads/' . $newName;
			} else {
				$file_path = $original_entry['photo_url'];
			}

			$model = new Entry();

			$newData = [
				'name' => $this->request->getVar('name'),
				'country' => $this->request->getVar('country'),
				'nationality' => $this->request->getVar('nationality'),
				'occupation' => $this->request->getVar('occupation'),
				'photo_url' => $file_path,
			];
			$model->update($id, $newData);
			session()->setFlashdata('success', 'تم تحديث المتعاون بنجاح!');
			return redirect()->to('/entries/' . $id . '/edit');
		}

		echo 1;

		return false;
	}

	public function delete($id)
	{
		$model = new Entry();
		$model->update($id, array('soft_delete' => 1));

		return true;
	}

	public function excel_export()
	{
		$entries_to_be_exported = $this->request->getVar('entries_to_be_exported');
		$entries_to_be_exported = explode(',', $entries_to_be_exported);

		$entries = new Entry();
		$entries = $entries
			->whereIn('id', $entries_to_be_exported)
			->findAll();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet()->setRightToLeft(true);
		$sheet->setCellValue('A1', 'الرقم');
		$sheet->setCellValue('B1', 'الإسم');
		$sheet->setCellValue('C1', 'البلد');
		$sheet->setCellValue('D1', 'الجنسية');
		$sheet->setCellValue('E1', 'المهنة');
		$sheet->setCellValue('F1', 'رابط الصورة');
		$sheet->setCellValue('G1', 'تاريخ الإنشاء');
		$sheet->setCellValue('H1', 'تاريخ التحديث');

		$counter = 2;
		foreach ($entries as $entry) {
			$sheet->setCellValue('A' . $counter, $entry['id']);
			$sheet->setCellValue('B' . $counter, $entry['name']);
			$sheet->setCellValue('C' . $counter, $entry['country']);
			$sheet->setCellValue('D' . $counter, $entry['nationality']);
			$sheet->setCellValue('E' . $counter, $entry['occupation']);
			$sheet->setCellValue('F' . $counter, $entry['photo_url']);
			$sheet->setCellValue('G' . $counter, $entry['created_at']);
			$sheet->setCellValue('H' . $counter, $entry['updated_at']);

			$counter++;
		}

		$writer = new Xlsx($spreadsheet);
		$writer->save('uploads/exported_data.xlsx');

		return redirect()->to(base_url() . '/uploads/exported_data.xlsx');
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
