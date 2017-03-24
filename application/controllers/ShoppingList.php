<?php
include_once('Core.php');

class ShoppingList extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('ShoppingList_model');
        $this->load->model('UseList_model');
    }

   /** @brief Displays all the lists of the logged user
   *
   * @detail Calls getLists($id) from ShoppingList_model
   */
   public function index()
   {
       $this->logged_user_only();

       $data['lists'] = $this->ShoppingList_model->getLists($this->session->userdata('id'));
      


       $this->smarty->view('List/all.tpl', $data);
   }


   /** @brief Creates a new list for the logged user
   *
   * @detail Calls createEmptyList($id_user) from ShoppingList_model
   *        Refreshes the page.
   */
   public function createList()
   {
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
   public function showList(int $id)
   {
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
   public function deleteList(int $id)
   {
       $this->ShoppingList_model->deleteList($id);
       redirect('home/list');
   }

   /** @brief Updates the name of the specified list
   *
   * @detail Calls setName($id, $name) from ShoppingList_model
   *
   * @param $id - A specified list id
   */
   public function updateTitle(int $id)
   {
       $data = json_decode($this->security->xss_clean($this->input->raw_input_stream));
       $response = new AJAX();
       if ($this->session->userdata('logged_in') !== true) {
           $response->addError('Error not logged');
       } else {
           $this->ShoppingList_model->setName($id, htmlentities($data->data));
           $response->addData('text', $this->ShoppingList_model->getListById($id)->name);
       }

       $response->send();
   }

   /** @brief Gets products with a name similar to the typed string
   *
   * @detail Calls getProductsLike($fragmented_name) from ShoppingList_model
   *
   * @param $fragmented_name - A string typed by the user
   */
   public function getProductsLike(string $fragmented_name)
   {
       $response = new AJAX();
       $response->addData('names', $this->ShoppingList_model->getProductsLike(htmlentities($fragmented_name)));

       $response->send();
   }

   /** @brief Adds a product to the specified list
   *
   * @detail Calls addProductToList($id_list, $id_prod) and
   *         getProductById($id_prod) from ShoppingList_model
   */
   public function addProduct(int $id_list, int $id_prod)
   {
       $response = new AJAX();

       if (!$this->ShoppingList_model->addProductToList($id_list, $id_prod)) {
           $response->addError("Erreur lors de l'ajout du produit");
       } else {
           $response->addData("product", $this->ShoppingList_model->getProductById($id_prod));
       }
       $response->send();
   }
   /** @brief Deletes a product from the specified list
   *
   * @detail Calls deleteProductToList($id_list, $id_prod) and
   *         getProductById($id_prod) from ShoppingList_model
   */
   public function deleteProduct(int $id_list, int $id_product)
   {
       $response = new AJAX();
       if ($this->ShoppingList_model->deleteProductFromList($id_list, $id_product)) {
           $response->addData("product", $this->ShoppingList_model->getProductById($id_product));
       }

       $response->send();
   }

   /** @brief Updates the amount of a specified product in a specified list
   *
   * @detail Calls setAmount($id_list, $id_product, $amount) from ShoppingList_model
   *
   * @param $id_list - A specified list id
   * @param $id_product - A specified product id
   * @param $amount - The new amount for the product
   */
   public function updateAmount(int $id_list, int $id_product, int $amount)
   {
       $response = new AJAX();
       if ($this->ShoppingList_model->setAmount($id_list, $id_product, $amount)) {
           $response->adddata("amount", $this->ShoppingList_model->getAmount($id_list, $id_product));
       }

       $response->send();
   }

   /** @brief Updates the note for the specified list
   *
   * @detail Calls updateNote($id_list, $note) from ShoppingList_model
   *
   * @param $ id_list - A specified list id
   */
   public function updateNote(int $id_list)
   {
       $data = json_decode($this->security->xss_clean($this->input->raw_input_stream));
       $response = new AJAX();

       $this->ShoppingList_model->updateNote($id_list, htmlentities($data->data));


       $response->addData('text', html_entity_decode(nl2br($this->ShoppingList_model->getListById($id_list)->note)));


       $response->send();
   }
}
