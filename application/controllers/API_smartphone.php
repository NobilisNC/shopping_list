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
        * @detail Verifies if the user is logged and if he owns the specified list.
        *         If yes, creates a new useList from the specified list
        *
        * @param $id - A specified list id
        */
        public function useList(int $id) {
          $response = new AJAX();
          if($this->session->userdata('logged_in') !== true )
            $response->addError('not logged');
          else if(!$this->ShoppingList_model->isOwner($id, $this->session->userdata('id')))
            $response->addError('You don\'t have access to this list');
          else {
                $id_list = $this->UseList_model->useList($id);
                $response->addData('id_list',  $id_list);
                $response->addData('products', $this->ShoppingList_model->getProducts($id));
            }


          $response->send();
        }


        /** @brief Deletes the specified useList
        *
        * @detail Calls deleteList($id) from UseList_model.
        *
        * @param $id - A specified useList id
        */
        public function stopList(int $id) {
          $this->UseList_model->deleteList($id);
        }

        /** @brief Checks a product as "taken" in the specified useList
        *
        * @detail Verifies if the user is logged, then calls check($id_product,
        *         $id_list) from UseList_model.
        *
        * @param $id_list - A specified useList id
        * @param $id_product - A specified product id
        */
        public function checkProduct(int $id_list, int $id_product) {
          $response = new AJAX();
          if($this->session->userdata('logged_in') !== true )
            $response->addError('not logged');
          else if(!$this->UseList_model->isOwner($id_list, $this->session->userdata('id')))
            $response->addError('You don\'t have access to this list');
          else if (!$this->UseList_model->check($id_product, $id_list)) {
            $response->addError('Erreur lors du check');
          }
          $response->send();
        }

        /** @brief Unchecks a checked product in the specified useList
        *
        * @detail Verifies if the user is logged, then calls uncheck($id_product,
        *         $id_list) from UseList_model.
        *
        * @param $id_list - A specified useList id
        * @param $id_product - A specified product id
        */
        public function uncheckProduct(int $id_list, int $id_product) {
          $response = new AJAX();
          if($this->session->userdata('logged_in') !== true )
            $response->addError('Not logged');
          else if(!$this->UseList_model->isOwner($id_list, $this->session->userdata('id')))
            $response->addError('You don\'t have access to this list');
          else if (!$this->UseList_model->uncheck($id_product, $id_list)){
            $response->addError('Erreur lors de l\'uncheck');
          }
          $response->send();
        }

        /** @brief Displays a specified useList
        *
        * @detail Verifies if the user is logged and is an owner of the useList,
        *         then calls getProducts($id) from UseList_model
        *
        * @param $id - A specified useList id
        */
        public function getList(int $id) {
          $response = new AJAX();
          if($this->session->userdata('logged_in') !== true )
            $response->addError('not logged');
           else if(!$this->UseList_model->isOwner($id, $this->session->userdata('id')))
            $response->addError('You don\'t have access to this list');
          else {
            $response->addData('products', $this->UseList_model->getProducts($id));
          }
          $response->send();
        }

        /** @brief Sorts the specified useList by weight
        *
        * @detail Verifies if the user is logged, then calls getProducts($id)
        *         from UseList_model and compares the returned products weight.
        *         Finally, displays the products from the heaviest to the lightest
        *
        * @param $id - A specified useList id
        */
        public function sortWeight(int $id) {
          $response = new AJAX();
          if($this->session->userdata('logged_in') !== true )
            $response->addError('not logged');
          else if(!$this->UseList_model->isOwner($id, $this->session->userdata('id')))
            $response->addError('You don\'t have access to this list');
          else {
            $products = $this->UseList_model->getProducts($id);

            function compare($a, $b) {
              return $a->weight < $b->weight;
            }

            usort($products, 'compare');
            $response->addData('products', $products);
          }

          $response->send();
        }

        /** @brief Sorts the specified useList by coldness
        *
        * @detail Verifies if the user is logged, then calls getProducts($id)
        *         from UseList_model and compares the returned products coldness level.
        *         Finally, displays the products from the less cold to the coldest
        *
        * @param $id - A specified useList id
        */
        public function sortColdness(int $id) {
          $response = new AJAX();
          if($this->session->userdata('logged_in') !== true )
            $response->addError('not logged');
           else if(!$this->UseList_model->isOwner($id, $this->session->userdata('id')))
            $response->addError('You don\'t have access to this list');
          else {
            $products = $this->UseList_model->getProducts($id);

            function compare($a, $b) {
              return $a->coldness < $b->coldness;
            }

            usort($products, 'compare');
            $response->addData('products', $products);
          }
          $response->send();
        }

  }
