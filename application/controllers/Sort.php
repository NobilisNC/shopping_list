<?php
include_once('Core.php');

class Sort extends Core_Controller {

    public function __construct() {
           parent::__construct();
           $this->load->model('user_model');
           $this->load->model('Sort_model');
   }

   /** @brief Displays the lists of the logged user
   *
   * @detail Calls getLists($id) from Sort_model
   */
   public function index() {
      $this->logged_user_only();

      $data['lists'] = $this->Sort_model->getLists($this->session->userdata('id'));

      $this->smarty->view('Sort/all.tpl', $data);
   }

   /** @brief Displays a selected list
   *
   * @param - int $id : a specified list id
   *
   * @detail Calls getListById($id) and getProducts($id) from Sort_model
   *          to display the list
   */
   public function showListSort(int $id) {
      $this->logged_user_only();

      $list = $this->Sort_model->getListById($id);
      $products = $this->Sort_model->getProducts($id);

      $this->smarty->view('Sort/show.tpl', array('list' => $list, 'products' => $products));
   }

   /** @brief Display the specified list sorted by weight
   *
   * @param - int $id : a specified list id
   *
   * @detail Calls getListById($id) and getProducts($id) from Sort_model
   *          to display the list. Creates a function comparer($a, $b)
   *          that compares two products weights and returns a boolean
   */
   public function sortWeight(int $id) {
      $this->logged_user_only();

      $list = $this->Sort_model->getListById($id);
      $products = $this->Sort_model->getProducts($id);

      function comparer($a, $b) {
        return ($a->weight < $b->weight);
      }

      usort($products, 'comparer');

      $this->smarty->view('Sort/show.tpl', array('list' => $list, 'products' => $products));
   }

   /** @brief Display the specified list sorted by coldness
   *
   * @param - int $id : a specified list id
   *
   * @detail Calls getListById($id) and getProducts($id) from Sort_model
   *          to display the list. Creates a function comparer($a, $b)
   *          that compares two products coldness and returns a boolean
   */
   public function sortColdness(int $id) {
      $this->logged_user_only();

      $list = $this->Sort_model->getListById($id);
      $products = $this->Sort_model->getProducts($id);

      function comparer($a, $b) {
        return ($a->coldness > $b->coldness);
      }

      usort($products, 'comparer');

      $this->smarty->view('Sort/show.tpl', array('list' => $list, 'products' => $products));
   }
}
