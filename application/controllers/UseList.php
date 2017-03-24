<?php
    include_once('Core.php');

    class UseList extends Core_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Product_model');
            $this->load->model('UseList_model');
            $this->load->model('user_model');
        }

        /** @brief Displays the specified UseList
        *
        * @detail Verifies if the user is logged and has the right to see this list.
        *         Calls getOwner($id) and getProducts($id) from UseList_model
        *
        * @param $id - A specified useList id
        */
        public function showUseList(int $id)
        {
            $this->logged_user_only();
          //TODO : Verifier que la personne a droit d'acces sur cette liste
          $data = array();
            $data['owner'] = $this->UseList_model->getOwner($id)[0]->login;
            $data['products'] = $this->UseList_model->getProducts($id);
            $data['list_id'] = $id;




            $this->smarty->view('API/show.tpl', $data);
        }

        /** @brief Adds the specified product in the specified useList
        *
        * @detail Calls addProduct($id_list, $id_product, $amount ) from UseList_model
        *
        * @param $id_list - A specified useList id
        * @param $id_product - The id of the product to be added
        * @param $amount - The amount of product the user wants to add
        */
        public function addProduct(int $id_list, int $id_product, int $amount)
        {
            $response = new AJAX();
            if ($this->UseList_model->addProduct($id_list, $id_product, $amount)) {
                $response->addData('product', $this->Product_model->getProductById($id_product));
                $response->addData('amount', $amount);
            } else {
                $reponse.addError('Erreur lors de l\'ajout du  produit');
            }

            $response->send();
        }
    }
