<?php
include_once('Core.php');

class ShoppingList extends Core_Controller {

    public function __construct() {
           parent::__construct();
           $this->load->model('user_model');
           $this->load->model('ShoppingList_model');
   }

   public function index() {
      $this->logged_user_only();

      $data['lists'] = $this->ShoppingList_model->getLists($this->session->userdata('id'));

      $this->smarty->view('List/all.tpl', $data);
   }

   public function createList() {
     $this->logged_user_only();
     $id = $this->user_model->id($this->session->userdata('login'));

     $this->ShoppingList_model->createEmptyList($id);

     redirect('home/list', 'refresh');
   }

   public function showList(int $id) {
     $this->logged_user_only();
     $list = $this->ShoppingList_model->getListById($id);
     $products = $this->ShoppingList_model->getProducts($id);

     $this->smarty->view('List/show.tpl', array('list' => $list, 'products' => $products));
   }

   public function deleteList(int $id) {
     $this->ShoppingList_model->deleteList($id);
     redirect('home/list');
   }


   public function changeName(int $id) {
     $data = json_decode($this->security->xss_clean($this->input->raw_input_stream));
     $response = array();
     if ($this->session->userdata('logged_in') !== TRUE)
         $response['error'] = 'error_not_logged';
    else {

      $this->ShoppingList_model->setName($id, htmlentities($data->new_name));
      $response['name'] = $this->ShoppingList_model->getListById($id)->name;

    }

      echo json_encode($response);
   }

   public function getProductsLike(string $fragmented_name) {
     $response = array();
     $response['names'] = $this->ShoppingList_model->getProductsLike($fragmented_name);

     echo json_encode($response);
   }

   public function addProduct(int $id_list, int $id_prod) {

     $response = array();
     $response["status"] = $this->ShoppingList_model->addProductToList($id_list, $id_prod);
     $response["product"] = $this->ShoppingList_model->getProductById($id_prod);
     echo json_encode($response);
   }

   public function deleteProduct(int $id_list, int $id_product) {
      $response = array();
      $response["status"] = $this->ShoppingList_model->deleteProductFromList($id_list, $id_product);
      $response["product"] = $this->ShoppingList_model->getProductById($id_product);

      echo json_encode($response);
   }

   public function setAmount(int $id_list, int $id_product, int $amount) {
     $response = array();
     $response["status"] =  $this->ShoppingList_model->setAmount($id_list, $id_product, $amount);
     $response["product"] = $this->ShoppingList_model->getAmount($id_list, $id_product);

     echo json_encode($response);
   }

}
