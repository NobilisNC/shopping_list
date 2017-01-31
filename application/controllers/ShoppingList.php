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

     $this->smarty->view('List/show.tpl', array('id' => $id));
   }

}
