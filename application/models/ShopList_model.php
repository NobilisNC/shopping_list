<?php

class ShopList_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

   /** @brief Gets the shop list for the specified user
    *
    * @param $user_id - A specified user's id
    *
    * @return The shop list
    */
    public function getShops(int $user_id){
        $this->db->from('shop');
        $this->db->join('user_shops','shop.id=user_shops.id_shop');
        $this->db->where('user_shops.id_user',$user_id);
        $this->db->where('shop.etat','approved');
        $query = $this->db->get();
        return $query->result();
    }

    /** @brief Gets all the shops
     *
     * @return The list of all the shops
     */
    public function getAllShops(){
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('shop');
        return $query->result();
    }

    /** @brief Gets shop giving the first letters of its name
     *
     * @param $in - The beginning of a shop name
     *
     * @return The name and location of corresponding shops
     */
    public function getShopIn(string $in){
        $this->db->select('name,location')
                 ->from('shop')
                 ->where("name LIKE '".$in."%'")
                 ->where('etat','approved')
                 ->order_by('name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function addShop($shop_data)
    {
        $query = $this->db->get_where('shop',$shop_data);

        if($query->num_rows() > 0){
            return FALSE;
        }else{
            $this->db->insert('shop',$shop_data);
            return TRUE;
        }
    }

    /** @brief Adds a shop to a specified user's shop list
     *
     * @param $user_id - A specified user's id
     * @param $shop_name - A specified shop name
     */
    public function addShopToUser($user_id, $shop_name){

        $shop_information = explode(" - ",$this->input->post('name_shop_to_add'));
        $name = $shop_information[0];
        $location = $shop_information[1];

        $this->db->select('id')
                  ->from('shop')
                  ->where('name',$name)
                  ->where('location',$location);

        $query = $this->db->get();
        $shop_id = $query->result();

        $data = array (
                'id_shop' => $shop_id[0]->id,
                'id_user' => $user_id
        );

        $query = $this->db->get_where('user_shops', $data);

        if ($query->num_rows() > 0 ) {
            //On fait rien
        } else {
                    $this->db->insert('user_shops', $data);
        }
    }

    /** @brief Delete a shop with a specified id
     *
     * @param $shop_id - A specified shop id
     */
    public function deleteShop(int $shop_id){
        $this->db->where('id',$shop_id);
        $this->db->delete('shop');
    }

    /** @brief Deletes a specified shop from a specified user's shop list
    *
    * @param $shop_id - A specified shop id
    * @param $user_id
    */
    public function deleteFromMyShops(int $shop_id,int $user_id){
        $this->db->where('id_shop',$shop_id)
        ->where('id_user',$user_id)
        ->delete('user_shops');
    }
}
?>
