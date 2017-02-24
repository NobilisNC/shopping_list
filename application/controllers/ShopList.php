<?php
    include_once('Core.php');

class ShopList extends Core_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('ShopList_model');
    }

    public function index()
    {
        $this->logged_user_only();
        //On affiche la liste des magasins
        $data['shops'] = $this->ShopList_model->getShops();
        $this->smarty->view('Shop/all.tpl',$data);
    }

    public function createShop(){
        $this->logged_user_only();
        //Cree un nouveau ShopList
        redirect('home/list','refresh');
    }
}
?>
