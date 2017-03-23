<?php
    include_once('Core.php');

    class Admin extends Core_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model('Product_model');
            $this->load->model('ShopList_model');
            $this->load->model('user_model');
        }

        /** @brief Displays the list of all the shops in the database
         *
         * @detail Calls getAllShops() from ShopList_model
         */
        public function shop_index(){
            $this->logged_user_only();
            $this->admin_user_only();
            $data['shop_add_success'] = $this->session->flashdata('shop_add_success');
            $data['shop_list'] = $this->ShopList_model->getAllShops();
            $this->smarty->view('Admin/shop_list.tpl',$data);
        }

       /** @brief Displays the list of all the products in the database
        *
        * @detail
        *
        */
        public function product_index(){
            $this->logged_user_only();
            $this->admin_user_only();

            $data = array();

            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Nom', 'required|callback_product_name_check');
            $this->form_validation->set_rules('weight', 'poids', 'required');
            //$this->form_validation->set_rules('volume', 'volume', 'required');

            if ($this->form_validation->run() == TRUE) {
              $product_data = array(
                  'name' => $this->input->post('name'),
                  'coldness' => $this->input->post('exp'),
                  'weight' => $this->input->post('weight'),
                  'volume' => 0
              );
              $this->Product_model->addproduct($product_data);
            }
            $data['products'] = $this->Product_model->getAllProduct();

            $this->smarty->view('Admin/product.tpl',$data);
        }

       /** @brief Allows the admin to delete a product
        *
        * @detail Calls deleteProduct($id_product) from Product_model
        *         then refreshes the page
        *
        * @param $id_product - The id of the product to be deleted
        */
        public function deleteProduct(int $id_product){
          $this->logged_user_only();
          $this->admin_user_only();
          $this->Product_model->deleteProduct($id_product);
          redirect('admin/product','refresh');
        }

       /** @brief Checks if the specified product already exists in the database
        *
        * @detail Calls name_exist($name) from Product_model
        *
        * @param $name - The name to check
        *
        * @return A boolean : FALSE if the product already exists, TRUE if it doesn't
        */
        public function product_name_check($name) {
          if($this->Product_model->name_exist($name)) {
              $this->form_validation->set_message('product_name_check', 'Ce {field} existe déjà.');
              return FALSE;
          } else
            return TRUE;
        }

        /** @brief Updates a specified product's name
        *
        * @param $id - A specified product id
        */
        public function updateProductName(int $id){
            $data = json_decode($this->security->xss_clean($this->input->raw_input_stream));
            $response = array();
            if($this->session->userdata('logged_in') !== TRUE)
                $response['error'] = 'error_not_logged';
            else{
                $this->Product_model->setName($id,htmlentities($data->data));
                $response['data'] = $this->Product_model->getProductById($id)->name;
            }
            echo json_encode($response);
        }

        /** @brief Deletes the specified shop
        *
        * @detail Calls deleteShop($id_shop) from ShopList_model.
        *         Refreshes the page once the shop is deleted
        *
        * @param $id_shop - The id of the shop to be deleted
        */
        public function deleteShop(int $id_shop){
            $this->logged_user_only();
            $this->admin_user_only();
            $is_deleted = $this->ShopList_model->deleteShop($id_shop);
            redirect('admin/shop','refresh');
        }

        /** @brief Displays the "add a shop" page
        *
        * @detail Displays a form to add a new shop. If the form is completed,
        *         it will create a new shop with the provided information
        *         in the database (calls addShop($shop_data) from ShopList_model)
        */
        public function addShop(){
            $this->logged_user_only();
            $this->admin_user_only();
            $data = array();
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('shop_name','Nom du magasin','required');
            $this->form_validation->set_rules('shop_location','Ville du magasin','required');

            if($this->form_validation->run() == TRUE){
                $shop_data = array(
                    'name' => $this->input->post('shop_name'),
                    'location' => $this->input->post('shop_location'),
                    'etat' => 'approved'
                );

                $this->session->set_flashdata('shop_add_success',$this->ShopList_model->addShop($shop_data));
                redirect('admin/shop','refresh');
            }
            else
            {
                redirect('admin/shop','refresh');
            }
        }
    }
?>
