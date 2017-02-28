<?php
    include_once('Core.php');

    class Admin extends Core_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model('Product_model');
            $this->load->model('ShopList_model');
            $this->load->model('user_model');
        }

        public function index(){
            $this->logged_user_only();
            $data['shop_list'] = $this->ShopList_model->getAllShops();
            $this->smarty->view('Admin/shop_list.tpl',$data);
        }

        public function product_index(){
            $this->logged_user_only();
            $data['products'] = $this->Product_model->getProduct();
            $this->smarty->view('Admin/product.tpl',$data);
        }

        public function createProduct(){
        $this->logged_user_only();
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('weight', 'poids', 'required');
        $this->form_validation->set_rules('volume', 'volume', 'required');


        $name=$this->input->post('name');
        $exp=$this->input->post('exp');
        $weight=$this->input->post('weight');
        $vol=$this->input->post('volume');
        $this->Product_model->addproduct($name,$exp,$weight,$vol);
        redirect('admin/product','refresh');
        }

        public function eraseProduct(int $id_product){
          $this->logged_user_only();
          $this->Product_model->supprproduct($name_product);
          redirect('admin/product','refresh');
        }

        public function deleteShop(int $id_shop){
            $this->logged_user_only();
            $is_deleted = $this->ShopList_model->deleteShop($id_shop);
            redirect('admin/shop','refresh');
        }
    }
?>
