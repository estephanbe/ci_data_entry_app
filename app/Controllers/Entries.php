<?php

namespace App\Controllers;

use App\Models\Entry;
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
		$this->view_data(array(
			'title' => 'عرض المتعاون',
			'entry' => array(
				"id" => 1,
				"name" => "بشارة عيسى نعيم اسطفان",
				"country" => "الأردن",
				"nationality" => "أردني",
				"occupation" => "مبرمج",
				"photo_url" => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAXVBMVEX/3IezeRz/34r/4YytcAqwdBTbrlr41H+/ijL/4oyvcxGxdhj+2oXrw2/UpVHFkTvnvmrLmUTiuGTzzXi3fiPOnknIlkDDjzj20HvftGC+iC+1fB+oaAC6gynwyHSl+4JbAAAD4UlEQVR4nO2c2VLcQAxFcTcGPGZJWEICCf//mXEWisVnvDBUWao65xE8VS364pau1HN0JCIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiY04n2Hptn0G5+Hm8l75uvbxPoH7tm73snsrW6/sEdvsDbPq7/JtYvkxF2PT597BeTYh0kOlF+hDPj6cCbPqv2WVafrSTETbt1is8lO5sUqSDTL8kl+nptEgHmX7LLdNyMiPSYRPPt17kQXS/5gJsdtepZXozJ9JBpvfd1qs8gHo5K9KmOc4s0zof33Be/Mgr0/I0mbE9y/Qhr0zr3cxh+F+meavEAgHCj9qTrDKlsqKnbf2V9dCv38bRHJdHkOnN1kv9IOewhfcdHCDtZU6ZlutxhLvr+gRJwG1OmXb3Y5EOSWhFmabcRCgr+qs65DnjwPvLjJtIte+fLJvTgIwRUlnxt1KiVC6lXfOdRcqZTkZXscCp8K8ULBcg04SuYr0FLf7/FaQ1+eyaArXvsyWDMk1n19CZ8LxPKNPdxgteTRnH8BJEgco/m11D2/QiRGpH/XvP5oFieHmZYLcmm10DIbz270mmqewaKite92BQpmeZ7Bpqqb0+8Vimmewaaqm1b0RIKk5k11BZ8bZRSAZHJlexPoBI31QPLNPvm614LdRSa99JkB5JI1Nqqb0vj7C9n8ZVrFT7vitx6TzJ4ypSS21U/4HV2LRJ7BpqqY1reJTpY5IIxysHHwZlmmMIjL208cpJpjnsmqVGUwXDOIddg+UtqA9niTK4ijypR+Kj5DXDEBhmnHgKVBqXSjAERi+Q3U1Xx3TXJNPwriIeAs0Z8gBPxncVqaU2rBuBBxO4irOTenNEdxUXTOrNEH0IbMGk3hzBXUVoqa0l9hAYtdTWEttVpJbaaiK7ioUmSVYT2a5ZOKk3R2C7hlpqHyCuq4idzw8Qdwhs8pbaGuIOgX3OFg4yDWrXcFnxEaIOgc3cUltFzAj5llrfToN/lZh2Dd9Say9PprmjT8V0FTtoqQ10ZQbMZEO6ilj7zr8zOA+KKFOufeff+5wmRHQVqaW2qNXCqV5AuwZvqS1pl+2RaThXkW+pLUlOuJMTbwiMb6k9LinX+aPRrpby+2JZkcDbH81V5H+mZdcoaNg2nqtYMOm+XbbIDt2dWHYNt9SWVrLs0MVyFamltmJ4BF3WWENg1FJbUaqzUx5Jplz7LrdbOOOL5Cryl1+smHDijlUgV/HgBXLlFWcI7HCR7aueo8i0PtLXeP1c4+ue4veB7aJEeBQshRQREREREREREREREREREREREREREREREREREREREdma38DULju5AqS1AAAAAElFTkSuQmCC",
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
		$this->view_data(array(
			'title' => 'تحديث متعاون',
			'entry' => array(
				"id" => 1,
				"name" => "بشارة عيسى نعيم اسطفان",
				"country" => "الأردن",
				"nationality" => "أردني",
				"occupation" => "مبرمج",
				"photo_url" => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAXVBMVEX/3IezeRz/34r/4YytcAqwdBTbrlr41H+/ijL/4oyvcxGxdhj+2oXrw2/UpVHFkTvnvmrLmUTiuGTzzXi3fiPOnknIlkDDjzj20HvftGC+iC+1fB+oaAC6gynwyHSl+4JbAAAD4UlEQVR4nO2c2VLcQAxFcTcGPGZJWEICCf//mXEWisVnvDBUWao65xE8VS364pau1HN0JCIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiY04n2Hptn0G5+Hm8l75uvbxPoH7tm73snsrW6/sEdvsDbPq7/JtYvkxF2PT597BeTYh0kOlF+hDPj6cCbPqv2WVafrSTETbt1is8lO5sUqSDTL8kl+nptEgHmX7LLdNyMiPSYRPPt17kQXS/5gJsdtepZXozJ9JBpvfd1qs8gHo5K9KmOc4s0zof33Be/Mgr0/I0mbE9y/Qhr0zr3cxh+F+meavEAgHCj9qTrDKlsqKnbf2V9dCv38bRHJdHkOnN1kv9IOewhfcdHCDtZU6ZlutxhLvr+gRJwG1OmXb3Y5EOSWhFmabcRCgr+qs65DnjwPvLjJtIte+fLJvTgIwRUlnxt1KiVC6lXfOdRcqZTkZXscCp8K8ULBcg04SuYr0FLf7/FaQ1+eyaArXvsyWDMk1n19CZ8LxPKNPdxgteTRnH8BJEgco/m11D2/QiRGpH/XvP5oFieHmZYLcmm10DIbz270mmqewaKite92BQpmeZ7Bpqqb0+8Vimmewaaqm1b0RIKk5k11BZ8bZRSAZHJlexPoBI31QPLNPvm614LdRSa99JkB5JI1Nqqb0vj7C9n8ZVrFT7vitx6TzJ4ypSS21U/4HV2LRJ7BpqqY1reJTpY5IIxysHHwZlmmMIjL208cpJpjnsmqVGUwXDOIddg+UtqA9niTK4ijypR+Kj5DXDEBhmnHgKVBqXSjAERi+Q3U1Xx3TXJNPwriIeAs0Z8gBPxncVqaU2rBuBBxO4irOTenNEdxUXTOrNEH0IbMGk3hzBXUVoqa0l9hAYtdTWEttVpJbaaiK7ioUmSVYT2a5ZOKk3R2C7hlpqHyCuq4idzw8Qdwhs8pbaGuIOgX3OFg4yDWrXcFnxEaIOgc3cUltFzAj5llrfToN/lZh2Dd9Say9PprmjT8V0FTtoqQ10ZQbMZEO6ilj7zr8zOA+KKFOufeff+5wmRHQVqaW2qNXCqV5AuwZvqS1pl+2RaThXkW+pLUlOuJMTbwiMb6k9LinX+aPRrpby+2JZkcDbH81V5H+mZdcoaNg2nqtYMOm+XbbIDt2dWHYNt9SWVrLs0MVyFamltmJ4BF3WWENg1FJbUaqzUx5Jplz7LrdbOOOL5Cryl1+smHDijlUgV/HgBXLlFWcI7HCR7aueo8i0PtLXeP1c4+ue4veB7aJEeBQshRQREREREREREREREREREREREREREREREREREREREdma38DULju5AqS1AAAAAElFTkSuQmCC",
			)
		));
		echo view('templates/header', $this->view_data);
		echo view('Entries/edit', $this->view_data);
		echo view('templates/footer', $this->view_data);
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
