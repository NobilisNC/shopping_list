<?php
    include_once('Core.php');

class ShopList extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('ShopList_model');
        $this->load->model('ShoppingList_model');
    }

    /** @brief Displays the shop list for the logged user
    *
    * @detail Calls getShops($id) from ShopList_model
    */
    public function index()
    {
        $this->logged_user_only();
        $id = $this->user_model->id($this->session->userdata('login'));
        //On affiche la liste des magasins
        $data['shops'] = $this->ShopList_model->getShops($id);
        $this->smarty->view('Shop/all.tpl', $data);
    }

    /** @brief ?
    *
    *
    *
    */
    public function createShop()
    {
        $this->logged_user_only();
        //Cree un nouveau ShopList
        redirect('home/shops', 'refresh');
    }

    /** @brief Searches for a shop with a specified name
    *
    * @detail Calls getShopIn($q) from ShopList_model to find the shop
    */
    public function getShops()
    {
        $q = $this->input->get('q');
        $q = strtolower($q);
        $shop_list = $this->ShopList_model->getShopIn($q);
        $result = array();
        foreach ($shop_list as $shop) {
            $result[] = $shop->name.' - '.$shop->location;
        }
        echo json_encode($result);
    }

    public function show(int $id)
    {
        $this->logged_user_only();
        $this->admin_user_only();

        $data = array();
        $data['shop'] = $this->ShopList_model->getShopById($id);
        $data['products'] = $this->ShopList_model->getProducts($id);


        $this->smarty->view('Shop/show.tpl', $data);
    }

    public function addProduct(int $id_shop, $id_product)
    {
        $response = new AJAX();

        if (!$this->ShopList_model->addProductToShop($id_shop, $id_product)) {
            $response->addError("Erreur lors de l'ajout du produit");
        } else {
            $response->addData("product", $this->ShoppingList_model->getProductById($id_product));
        }

        $response->send();
    }

    public function deleteProduct(int $id_shop, int $id_product)
    {
        $this->logged_user_only();
        $this->admin_user_only();

        $this->ShopList_model->deleteProductFromShop($id_shop, $id_product);

        redirect('admin/shop/show/'.$id_shop, 'refresh');
    }
}
