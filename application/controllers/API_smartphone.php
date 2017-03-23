<?php
    include_once('Core.php');

    class API_smartphone extends Core_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model('Product_model');
            $this->load->model('ShoppingList_model');
            $this->load->model('user_model');
            $this->load->model('UseList_model');
        }

        /** @brief Creates a new useList from an existing list
        *
        *
        *
        *
        *
        */
        public function useList(int $id) {
          $response = array();
          if($this->session->userdata('logged_in') !== true )
            $response['error'] = array('not logged');
          else if(!$this->ShoppingList_model->isOwner($id, $this->session->userdata('id')))
            $response['error'] = array('You don\'t have access to this list');
          else {
            $id_list = $this->UseList_model->useList($id);

            $response['data']['id_list'] = $id_list;
            $response['data']['products'] = $this->ShoppingList_model->getProducts($id);
          }

          echo json_encode($response);
        }


        public function stopList(int $id) {
          $this->UseList_model->deleteList($id);
        }

        public function checkProduct(int $id_list, int $id_product) {
          $reponse = array();
          if($this->session->userdata('logged_in') !== true )
            $response['error'] = array('not logged');
          /* else if(!$this->ShoppingList_model->isOwner($id, $this->session->userdata('id')))
            $response['error'] = array('You don\'t have access to this list'); */
          else {
            $response['data']['status'] = $this->UseList_model->check($id_product, $id_list);
          }
          echo json_encode($response);
        }

        public function uncheckProduct(int $id_list, int $id_product) {
          $reponse = array();
          if($this->session->userdata('logged_in') !== true )
            $response['error'] = array('not logged');
          /* else if(!$this->ShoppingList_model->isOwner($id, $this->session->userdata('id')))
            $response['error'] = array('You don\'t have access to this list'); */
          else {
            $response['data']['status'] = $this->UseList_model->uncheck($id_product, $id_list);
          }
          echo json_encode($response);
        }

        public function getList(int $id) {
          $reponse = array();
          if($this->session->userdata('logged_in') !== true )
            $response['error'] = array('not logged');
           else if(!$this->UseList_model->isOwner($id, $this->session->userdata('id')))
            $response['error'] = array('You don\'t have access to this list');
          else {
            $response['data']['products'] = $this->UseList_model->getProducts($id);
          }
          echo json_encode($response);
        }

        public function sortWeight(int $id) {
          $reponse = array();
          if($this->session->userdata('logged_in') !== true )
            $response['error'] = array('not logged');
          /* else if(!$this->ShoppingList_model->isOwner($id, $this->session->userdata('id')))
            $response['error'] = array('You don\'t have access to this list'); */
          else {
            $products = $this->UseList_model->getProducts($id);

            function compare($a, $b) {
              return $a->weight < $b->weight;
            }

            usort($products, 'compare');
            $response['data']['products'] = $products;
          }
          echo json_encode($response);
        }

        public function sortColdness(int $id) {
          $reponse = array();
          if($this->session->userdata('logged_in') !== true )
            $response['error'] = array('not logged');
           else if(!$this->UseList_model->isOwner($id, $this->session->userdata('id')))
            $response['error'] = array('You don\'t have access to this list');
          else {
            $products = $this->UseList_model->getProducts($id);

            function compare($a, $b) {
              return $a->coldness < $b->coldness;
            }

            usort($products, 'compare');
            $response['data']['products'] = $products;
          }
          echo json_encode($response);
        }

  }
