<?php

class ShopList_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    /** @brief Gets all the shops
     *
     * @return The list of all the shops
     */
    public function getAllShops()
    {
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
    public function getShopIn(string $in)
    {
        $this->db->select('name,location')
                 ->from('shop')
                 ->where("name LIKE '".$in."%'")
                 ->order_by('name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getShopById($id)
    {
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
        $query = $this->db->get_where('shop', $shop_data);

        if ($query->num_rows() > 0) {
            return false;
        } else {
            $this->db->insert('shop', $shop_data);
            return true;
        }
    }


    /** @brief Delete a shop with a specified id
     *
     * @param $shop_id - A specified shop id
     */
    public function deleteShop(int $shop_id)
    {
        $this->db->where('id', $shop_id);
        $this->db->delete('shop');
    }


    /** @brief Gets all products from the specified shop
    *
    * @param $id - A specified shop id
    *
    * @return An array with all the data from all the products
    */
    public function getProducts(int $id)
    {
        $query = $this->db->select(array('product.name', 'product.id'))
               ->from('shop_product')
               ->join('product', 'shop_product.id_product = product.id')
               ->where('id_shop = '.$id)
               ->get();

        return $query->result();
    }

    /** @brief Adds the specified product to the specified shop
    *
    * @param $id_sop - A specified shop id
    * @param $id_product - A specified product id
    */
    public function addProductToShop(int $id_shop, string $id_product)
    {
        $data = array(
           'id_shop' => $id_shop,
           'id_product' => $id_product,
         );

        return $this->db->insert('shop_product', $data);
    }


    /** @brief Deletes a product for a specified shop
     *
     * @param $id_shop - A specified shop id
     * @param $id_product - The id of the product to add
     *
     * @return Boolean : True if the product is deleted, false if it is not.
     */
    public function deleteProductFromShop(int $id_shop, int $id_product)
    {
        return $this->db->where(array('id_shop' => $id_shop, 'id_product' => $id_product))
                        ->delete('shop_product');
    }


    /** @brief Sets location of the specified shop
    *
    * @param $id_shop - A specified shop id
    * @param $new_location - The new location for this shop
    *
    */
    public function setLocation(int $id_shop, $new_location)
    {
        $this->db->where('id', $id_shop);
        $this->db->update('shop', array('location' => $new_location));
    }

    /** @brief Sets the name of the specified shop
    *
    * @param $id_shop - A specified shop id
    * @param $new_location - The new name for this shop
    */
    public function setName(int $id_shop, $new_name)
    {
        $this->db->where('id', $id_shop);
        $this->db->update('shop', array('name' => $new_name));
    }
}
