<?php
    include_once('Core.php');

    class Admin extends Core_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Product_model');
            $this->load->model('ShopList_model');
            $this->load->model('user_model');
        }

        /** @brief Displays the list of all the shops in the database
         *
         * @detail Calls getAllShops() from ShopList_model
         */
        public function shop_index()
        {
            $this->logged_user_only();
            $this->admin_user_only();
            $data['shop_add_success'] = $this->session->flashdata('shop_add_success');
            $data['shop_list'] = $this->ShopList_model->getAllShops();
            $this->smarty->view('Admin/shop_list.tpl', $data);
        }

       /** @brief Displays the product administration page
        *
        * @detail Displays the list of all products in the database, and
        *         a form to add a new product. If the form is correctly
        *         completed, calls addproduct($product_data) from Product_model
        */
        public function product_index()
        {
            $this->logged_user_only();
            $this->admin_user_only();

            $data = array();

            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Nom', 'required|callback_product_name_check');
            $this->form_validation->set_rules('weight', 'poids', 'required');
            //$this->form_validation->set_rules('volume', 'volume', 'required');

            if ($this->form_validation->run() == true) {
                $product_data = array(
                  'name' => $this->input->post('name'),
                  'coldness' => $this->input->post('exp'),
                  'weight' => $this->input->post('weight'),
              );
                $this->Product_model->addproduct($product_data);
            }
            $data['products'] = $this->Product_model->getAllProduct();

            $this->smarty->view('Admin/product.tpl', $data);
        }

       /** @brief Allows the admin to delete a product
        *
        * @detail Calls deleteProduct($id_product) from Product_model
        *         then refreshes the page
        *
        * @param $id_product - The id of the product to be deleted
        */
        public function deleteProduct(int $id_product)
        {
            $this->logged_user_only();
            $this->admin_user_only();
            $this->Product_model->deleteProduct($id_product);
            redirect('admin/product', 'refresh');
        }

       /** @brief Checks if the specified product already exists in the database
        *
        * @detail Calls name_exist($name) from Product_model
        *
        * @param $name - The name to check
        *
        * @return A boolean : FALSE if the product already exists, TRUE if it doesn't
        */
        public function product_name_check($name)
        {
            if ($this->Product_model->name_exist($name)) {
                $this->form_validation->set_message('product_name_check', 'Ce {field} existe déjà.');
                return false;
            } else {
                return true;
            }
        }

        /** @brief Updates a specified product's name
        *
        * @param $id - A specified product id
        */
        public function updateProductName(int $id)
        {
            $this->admin_user_only();
            $data = json_decode($this->security->xss_clean($this->input->raw_input_stream));
            $response = new AJAX();
            if ($this->session->userdata('logged_admin') !== true) {
                $response->addError('error_not_logged');
            } else {
                $this->Product_model->setName($id, htmlentities($data->data));
                $response->addData('text', $this->Product_model->getProductById($id)->name);
            }
            $response->send();
        }

        public function updateProductColdness(int $id)
        {
            $this->admin_user_only();
            $data = json_decode($this->security->xss_clean($this->input->raw_input_stream));
            $response = new AJAX();
            if ($this->session->userdata('logged_admin') != true) {
                $response->addError('error_not_logged');
            } else {
                $this->Product_model->setColdness($id, htmlentities($data->data));
                $response->addData('text', $this->Product_model->getProductById($id)->coldness);
            }
            $response->send();
        }

        public function updateProductWeight(int $id)
        {
            $this->admin_user_only();
            $data = json_decode($this->security->xss_clean($this->input->raw_input_stream));
            $response = new AJAX();
            if ($this->session->userdata('logged_admin') != true) {
                $response->addError('error_not_logged');
            } else {
                $this->Product_model->setWeight($id, htmlentities($data->data));
                $response->addData('text', $this->Product_model->getProductById($id)->weight);
            }
            $response->send();
        }

        /** @brief Deletes the specified shop
        *
        * @detail Calls deleteShop($id_shop) from ShopList_model.
        *         Refreshes the page once the shop is deleted
        *
        * @param $id_shop - The id of the shop to be deleted
        */
        public function deleteShop(int $id_shop)
        {
            $this->logged_user_only();
            $this->admin_user_only();
            $is_deleted = $this->ShopList_model->deleteShop($id_shop);
            redirect('admin/shop', 'refresh');
        }

        /** @brief Displays the "add a shop" page
        *
        * @detail Displays a form to add a new shop. If the form is completed,
        *         it will create a new shop with the provided information
        *         in the database (calls addShop($shop_data) from ShopList_model)
        */
        public function addShop()
        {
            $this->logged_user_only();
            $this->admin_user_only();
            $data = array();
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('shop_name', 'Nom du magasin', 'required');
            $this->form_validation->set_rules('shop_location', 'Ville du magasin', 'required');

            if ($this->form_validation->run() == true) {
                $shop_data = array(
                    'name' => $this->input->post('shop_name'),
                    'location' => $this->input->post('shop_location'),

                );

                $this->session->set_flashdata('shop_add_success', $this->ShopList_model->addShop($shop_data));
                redirect('admin/shop', 'refresh');
            } else {
                redirect('admin/shop', 'refresh');
            }
        }

        public function updateShopName(int $id)
        {
            $this->admin_user_only();
            $data = json_decode($this->security->xss_clean($this->input->raw_input_stream));
            $response = new AJAX();
            if ($this->session->userdata('logged_admin') != true) {
                $response->addError('error_not_logged');
            } else {
                $this->ShopList_model->setName($id, htmlentities($data->data));
                $response->addData('text', $this->ShopList_model->getShopById($id)->name);
            }
            $response->send();
        }

        public function updateShopLocation(int $id)
        {
            $this->admin_user_only();
            $data = json_decode($this->security->xss_clean($this->input->raw_input_stream));
            $response = new AJAX();
            if ($this->session->userdata('logged_admin') != true) {
                $response->addError('error_not_logged');
            } else {
                $this->ShopList_model->setLocation($id, htmlentities($data->data));
                $response->addData('text', $this->ShopList_model->getShopById($id)->location);
            }
            $response->send();
        }

        public function user_management_index()
        {
            $this->super_user_only();
            $data = array();
            $data['users'] = $this->user_model->getAllUsers();
            $this->smarty->view('Admin/user_management.tpl', $data);
        }

        public function switchUserRank(int $id)
        {
            $this->logged_user_only();
            $this->admin_user_only();
            $this->super_user_only();
            $this->user_model->switchRank($id);
            redirect('admin/users', 'refresh');
        }

        public function deleteUser(int $id)
        {
            $this->logged_user_only();
            $this->admin_user_only();
            $this->super_user_only();
            $this->user_model->deleteUser($id);
            redirect('admin/users', 'refresh');
        }
    }
