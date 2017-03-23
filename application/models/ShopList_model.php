<?php

class ShopList_model extends CI_Model{
    public function __construct(){
        $this->load->database();
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

    public function getShopById($id){
        return $this->db->get_where('shop', array('id' => $id))->result()[0];
    }

    /** @brief Adds a shop in the database
     *
     * @param $shop_data - An array containing the information about the shop
     *
     * @return Boolean : TRUE if the shop is added, FALSE if it is not (probably already in the database)
     */
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
    * @param $user_id - A specified user's id
    */
    public function deleteFromMyShops(int $shop_id,int $user_id){
        $this->db->where('id_shop',$shop_id)
        ->where('id_user',$user_id)
        ->delete('user_shops');
    }

    public function setName($id_shop,$new_name){
        $this->db->where('id',$id_shop);
        $this->db->update('shop',array('name' => $new_name));
    }

    public function setLocation($id_shop,$new_location){
        $this->db->where('id',$id_shop);
        $this->db->update('shop',array('location' => $new_location));
    }
}
?>
