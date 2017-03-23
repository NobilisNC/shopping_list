<?php
    include_once('Core.php');

    class UseList extends Core_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model('Product_model');
            $this->load->model('UseList_model');
            $this->load->model('user_model');
        }

        public function showUseList(int $id) {
          $this->logged_user_only();
          //TODO : Verifier que la personne a droit d'acces sur cette liste
          $data = array();
          $data['owner'] = $this->UseList_model->getOwner($id)[0]->login;
          $data['products'] = $this->UseList_model->getProducts($id);
          $data['list_id'] = $id;




          $this->smarty->view('API/show.tpl', $data);
        }

        public function addProduct(int $id_list, int $id_product, int $amount) {
          $response = new AJAX();
          if($this->UseList_model->addProduct($id_list, $id_product, $amount ))
            $response->addData('product', $this->Product_model->getProductById($id_product));
          else
          $reponse.addError('Erreur lors de l\'ajout du  produit' );

          $response->send();
        }

}