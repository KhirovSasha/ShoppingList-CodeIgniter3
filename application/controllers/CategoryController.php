<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CategoryController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CategoryModel');
        $this->load->library('form_validation');
    }

    public function create()
    {
        $this->load->view('templates/header');
        $this->load->view('categories/createPage');
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('name', 'Category Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('categories/createPage');
            $this->load->view('templates/footer');
        } else {
            $categoryName = $this->input->post('name');
            $this->CategoryModel->create($categoryName);
            redirect('MainePageController');
        }
    }

    public function getAllCategories()
    {
        $array = $this->CategoryModel->getAllCategories();

        echo json_encode($array);
    }
}
