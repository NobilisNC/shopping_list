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
            $data['shop_add_success'] = $this->session->flashdata('shop_add_success');
            $data['shop_list'] = $this->ShopList_model->getAllShops();
            $this->smarty->view('Admin/shop_list.tpl',$data);
        }

        public function product_index(){
            $this->logged_user_only();
            $this->load->library('form_validation');
            $data['products'] = $this->Product_model->getProduct();
            $this->smarty->view('Admin/product.tpl',$data);
        }

        public function createProduct(){
        $this->logged_user_only();
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Nom', 'required|callback_product_name_check');
        $this->form_validation->set_rules('weight', 'poids', 'required');
        $this->form_validation->set_rules('volume', 'volume', 'required');

        $product_data = array(
            'name' => $this->input->post('name'),
            'coldness' => $this->input->post('exp'),
            'weight' => $this->input->post('weight'),
            'volume' => $this->input->post('volume')
        );

        $this->Product_model->addproduct($product_data);
        redirect('admin/product','refresh');
        }

        public function deleteProduct(int $id_product){
          $this->logged_user_only();
          $this->Product_model->deleteProduct($id_product);
          redirect('admin/product','refresh');
        }

        public function product_name_check($name) {
          if()

        }






        public function deleteShop(int $id_shop){
            $this->logged_user_only();
            $is_deleted = $this->ShopList_model->deleteShop($id_shop);
            redirect('admin/shop','refresh');
        }

        public function addShop(){
            $this->logged_user_only();
            $data = array();
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('shop_name','Nom du magasin','required');
            $this->form_validation->set_rules('shop_location','Ville du magasin','required');

            if($this->form_validation->run() == TRUE){
                $shop_data = array(
                    'name' => $this->input->post('shop_name'),
                    'location' => $this->input->post('shop_location'),
                    'etat' => 'approved'
                );

                $this->session->set_flashdata('shop_add_success',$this->ShopList_model->addShop($shop_data));
                redirect('admin/shop','refresh');
            }
            else
            {
                redirect('admin/shop','refresh');
            }
        }
    }
?>
