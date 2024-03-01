<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CategoryController extends CI_Controller
{
    public function create()
    {
        $this->load->view('templates/header');
        $this->load->view('categories/createPage');
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $categoryName = $this->input->post('name');

        $this->load->model('CategoryModel');
        $this->CategoryModel->create($categoryName);

        redirect('MainePageController');
    }

    public function getAllCategories()
    {
        $this->load->model("CategoryModel");
        $array = $this->CategoryModel->getAllCategories();

        echo json_encode($array);
    }
}
