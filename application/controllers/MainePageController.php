<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainePageController extends CI_Controller {

	public function index()
	{
		$this->load->model('CategoryModel');
        $data['categories'] = $this->CategoryModel->getAllCategories();

		$this->load->view('templates/header');
		$this->load->view('MainePage', $data);
		$this->load->view('templates/footer');
	}
}
