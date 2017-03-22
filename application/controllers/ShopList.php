<?php
    include_once('Core.php');

class ShopList extends Core_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('ShopList_model');
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
        $this->smarty->view('Shop/all.tpl',$data);
    }

    /** @brief ?
    *
    *
    *
    */
    public function createShop(){
        $this->logged_user_only();
        //Cree un nouveau ShopList
        redirect('home/shops','refresh');
    }

    /** @brief Searches for a shop with a specified name
    *
    * @detail Calls getShopIn($q) from ShopList_model to find the shop
    */
    public function getShops(){
            $q = $this->input->get('q');
            $q = strtolower($q);
            $shop_list = $this->ShopList_model->getShopIn($q);
            $result = array();
            foreach($shop_list as $shop)
            {
                $result[] = $shop->name.' - '.$shop->location;
            }
            echo json_encode($result);
    }

    /** @brief Adds the specified shop to the logged user shop list
    *
    * @detail Calls addShopToUser($id, $name) from ShopList_model and
    *         refreshes the page
    */
    public function addToMyShops(){
        $this->logged_user_only();
        $id = $this->user_model->id($this->session->userdata('login'));

        $this->ShopList_model->addShopToUser($id,$this->input->post('name_shop_to_add'));
        redirect('home/shops','refresh');
    }

    /** @brief Deletes the specified shop from the logged user shop list
    *
    *
    *
    */
    public function deleteFromMyShops(int $id_shop){
        $this->logged_user_only();
        $id_user = $this->user_model->id($this->session->userdata('login'));
        $is_deleted = $this->ShopList_model->deleteFromMyShops($id_shop,$id_user);
        redirect('home/shops','refresh');
    }
}

?>
