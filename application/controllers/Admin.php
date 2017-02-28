<?php
    include_once('Core.php');

    class Admin extends Core_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model('ShopList_model');
            $this->load->model('user_model');
        }

        public function index(){
            $this->logged_user_only();
            $data['shop_list'] = $this->ShopList_model->getAllShops();
            $this->smarty->view('Admin/shop_list.tpl',$data);
        }
    }
?>
