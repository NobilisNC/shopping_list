<?php
include_once('Core.php');

class Sort extends Core_Controller {

    public function __construct() {
           parent::__construct();
           $this->load->model('user_model');
           $this->load->model('Sort_model');
   }

   public function index() {
      $this->logged_user_only();

      $data['lists'] = $this->Sort_model->getLists($this->session->userdata('id'));

      $this->smarty->view('Sort/all.tpl', $data);
   }

   public function showListSort(int $id) {
      $this->logged_user_only();

      $list = $this->Sort_model->getListById($id);
      $products = $this->Sort_model->getProducts($id);

      $this->smarty->view('Sort/show.tpl', array('list' => $list, 'products' => $products));
   }

   public function sortWeight(int $id) {
      $this->logged_user_only();

      $list = $this->Sort_model->getListById($id);
      $products = $this->Sort_model->getProducts($id);

      function comparer($a, $b) {
        return ($a->weight > $b->weight);
      }

      usort($products, 'comparer');

      $this->smarty->view('Sort/show.tpl', array('list' => $list, 'products' => $products));
   }

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
