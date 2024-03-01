<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ShoppingItemController extends CI_Controller
{
    public function create()
    {
        $this->load->model('CategoryModel');
        $data['categories'] = $this->CategoryModel->getAllCategories();

        $this->load->view('templates/header');
        $this->load->view('shoppingItems/createPage', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $data['title'] = $this->input->post('title');
        $data['price'] = $this->input->post('price');
        $data['category_id'] = $this->input->post('category_id');

        $this->load->model('ShoppingItemModel');
        $this->ShoppingItemModel->create($data);

        redirect('MainePageController');
    }

    public function getItemsByCategories()
    {
        $filter = $this->input->get('filter');

        $this->load->model('ShoppingItemModel');

        if ($filter != null) {
            if($filter != "sold" && $filter != "available"){
                $result = $this->ShoppingItemModel->filterItemsByCategories($filter);
            } else {
                $result = $this->ShoppingItemModel->filterItemsByStatus($filter);
            }
           
        } else {
            $result = $this->ShoppingItemModel->getItemsByCategories();
        }

        echo json_encode($result);
    }

    public function deleteItem($id)
    {
        $this->load->model('ShoppingItemModel');
        $result = $this->ShoppingItemModel->deleteItem($id);

        echo json_encode($result);
    }

    public function changeStatus($id)
    {
        $this->load->model('ShoppingItemModel');
        $result = $this->ShoppingItemModel->changeStatus($id);

        echo json_encode($result);
    }
}
