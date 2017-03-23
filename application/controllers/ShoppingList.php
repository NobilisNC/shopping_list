<?php
include_once('Core.php');

class ShoppingList extends Core_Controller {

    public function __construct() {
           parent::__construct();
           $this->load->model('user_model');
           $this->load->model('ShoppingList_model');
   }

   /** @brief Displays all the lists of the logged user
   *
   * @detail Calls getLists($id) from ShoppingList_model
   */
   public function index() {
      $this->logged_user_only();

      $data['lists'] = $this->ShoppingList_model->getLists($this->session->userdata('id'));

      $this->smarty->view('List/all.tpl', $data);
   }


   /** @brief Creates a new list for the logged user
   *
   * @detail Calls createEmptyList($id_user) from ShoppingList_model
   *        Refreshes the page.
   */
   public function createList() {
     $this->logged_user_only();
     $id = $this->user_model->id($this->session->userdata('login'));

     $this->ShoppingList_model->createEmptyList($id);

     redirect('home/list', 'refresh');
   }

   /** @brief Displays the specified list
   *
   * @param - int $id : a specified list id
   *
   * @detail Calls getListById($id) and getProducts($id) from ShoppingList_model
   *         to display the list
   */
   public function showList(int $id) {
     $this->logged_user_only();
     $list = $this->ShoppingList_model->getListById($id);
     $products = $this->ShoppingList_model->getProducts($id);

     $this->smarty->view('List/show.tpl', array('list' => $list, 'products' => $products));
   }

   /** @brief Deletes the specified list
   *
   * @detail Calls deleteList($id) from ShoppingList_model.
   *         Redirects to home/list after the deletion
   */
   public function deleteList(int $id) {
     $this->ShoppingList_model->deleteList($id);
     redirect('home/list');
   }

   /** @brief Updates the name of the specified list
   *
   * @detail Calls setName($id, $name) from ShoppingList_model
   *
   * @param $id - A specified list id
   */
   public function updateTitle(int $id) {
     $data = json_decode($this->security->xss_clean($this->input->raw_input_stream));
     $response = array();
     if ($this->session->userdata('logged_in') !== TRUE)
         $response['error'] = 'error_not_logged';
    else {
      $this->ShoppingList_model->setName($id, htmlentities($data->data));
      $response['data'] = $this->ShoppingList_model->getListById($id)->name;

    }

      echo json_encode($response);
   }

   /** @brief Gets products with a name similar to the typed string
   *
   * @detail Calls getProductsLike($fragmented_name) from ShoppingList_model
   *
   * @param $fragmented_name - A string typed by the user
   */
   public function getProductsLike(string $fragmented_name) {
     $response = array();
     $response['names'] = $this->ShoppingList_model->getProductsLike(htmlentities($fragmented_name));

     echo json_encode($response);
   }

   /** @brief Adds a product to the specified list
   *
   * @detail Calls addProductToList($id_list, $id_prod) and
   *         getProductById($id_prod) from ShoppingList_model
   */
   public function addProduct(int $id_list, int $id_prod) {

     $response = array();
     $response["status"] = $this->ShoppingList_model->addProductToList($id_list, $id_prod);
     $response["product"] = $this->ShoppingList_model->getProductById($id_prod);
     echo json_encode($response);
   }
   /** @brief Deletes a product from the specified list
   *
   * @detail Calls deleteProductToList($id_list, $id_prod) and
   *         getProductById($id_prod) from ShoppingList_model
   */
   public function deleteProduct(int $id_list, int $id_product) {
      $response = array();
      $response["status"] = $this->ShoppingList_model->deleteProductFromList($id_list, $id_product);
      $response["product"] = $this->ShoppingList_model->getProductById($id_product);

      echo json_encode($response);
   }

   /**
   *
   *
   *
   *
   */
   public function updateAmount(int $id_list, int $id_product, int $amount) {
     $response = array();
     $response["status"] =  $this->ShoppingList_model->setAmount($id_list, $id_product, $amount);
     $response["amount"] =  $this->ShoppingList_model->getAmount($id_list, $id_product);

     echo json_encode($response);
   }


   public function updateNote(int $id_list) {
      $data = json_decode($this->security->xss_clean($this->input->raw_input_stream));

      $this->ShoppingList_model->updateNote($id_list, htmlentities($data->data));

      $response = array();
      $response["data"] = html_entity_decode(nl2br($this->ShoppingList_model->getListById($id_list)->note));


      echo json_encode($response);
   }
}
