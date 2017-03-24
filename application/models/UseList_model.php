<?php

class UseList_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    /** @brief Creates a useList
     *
     * @param $id_list - The id for the list to be created
     *
     * @return $id_use_list - id of using list
     **/
    public function useList(int $id_list)
    {
        //Create instance of `use_list`
      $id_use_list = rand();
        $this->db->insert('use_list', array('id' => $id_use_list, 'id_list' => $id_list));
      //$id_use_list = $this->db->get_where('use_list', array('id_list' => $id_list))->result()[0]->id;

      $products = $this->db->get_where('list_product', array('id_list' => $id_list))->result();

        foreach ($products as $p) {
            $this->db->insert('use_list_product', array(
            'id_list' => $id_use_list,
            'id_product' => $p->id_product,
            'amount' => $p->amount
        ));
        }

        return $id_use_list;
    }

    /** @brief Deletes the specified useList
    *
    * @param $id - The id of the list to be deleted
    *
    * @return Boolean - operation of deletion has worked
    */
    public function deleteList(int $id)
    {
        return $this->db->where(array('id' => $id))
               ->delete('use_list');
    }

    /** @brief Gets the products in the specified useList
    *
    * @param $id - A specified useList id
    *
    * @return $results - An array with all the information about each product
    */
    public function getProducts(int $id)
    {
        $this->db->select(array('id', 'name', 'amount', 'checked', 'weight', 'coldness'))
               ->from('use_list_product')
               ->join('product', 'use_list_product.id_product = product.id')
               ->where('use_list_product.id_list = '.$id);

        $results = $this->db->get()->result();
        return $results;
    }

    /** @brief Checks a product as "taken" in the specified useList
    *
    * @param $id_product - The checked product id
    * @param $id_list - The list id
    */
    public function check(int $id_product, int $id_list)
    {
        return $this->db->set('checked', true)
                      ->where(array('id_list' => $id_list, 'id_product' => $id_product))
                      ->update('use_list_product');
    }

    /** @brief Unchecks a checked product in the specified useList
    *
    * @param $id_product - The checked product id
    * @param $id_list - The list id
    */
    public function uncheck(int $id_product, int $id_list)
    {
        return $this->db->set('checked', false)
                      ->where(array('id_list' => $id_list, 'id_product' => $id_product))
                      ->update('use_list_product');
    }


    /** @brief Verifies if the specified user is the owner of the
    *          specified useList
    *
    * @param $id_list - A specified useList id
    * @param $id_user - A specified user id
    *
    * @return Boolean - TRUE if the user is the owner, FALSE if he's not
    */
    public function isOwner(int $id_list, int $id_user)
    {
        $this->db->select(array('user.id'))
              ->from('use_list')
              ->join('list', 'use_list.id_list = list.id')
              ->join('user', 'list.id_user = user.id')
              ->where('user.id = '.$id_user)
              ->where('use_list.id = '.$id_list);

        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /** @brief Gets the owner of the specified list
    *
    * @param $id_list - A specified list id
    *
    * @return Information about the user owning the list
    */
    public function getOwner(int $id_list)
    {
        $this->db->select(array('user.id', 'user.login'))
              ->from('use_list')
              ->join('list', 'use_list.id_list = list.id')
              ->join('user', 'list.id_user = user.id');

        $result = $this->db->get()->result();
        return $result;
    }

    /** @brief Adds the specified product in the specified useList
    *
    * @param $id_list - A specified useList id
    * @param $id_product - The id of the product to be added
    * @param $amount - The amount of product the user wants to add
    */
    public function addProduct(int $id_list, int $id_product, int $amount)
    {
        return $this->db->insert('use_list_product', array(
                                              'id_list' => $id_list,
                                              'id_product' => $id_product,
                                              'amount' =>$amount
                                            ));
    }

    /** @brief Gets the lists of the specified friend
    *
    * @param $friend_logins - One of the user's friends' login
    *
    * @return The id of this friend's list
    */
    public function getListsFriend($friend_logins)
    {
        $id_lists = array();

        foreach ($friend_logins as $login => $state) {
            $query = $this->db->select(array('login', 'list.name', 'use_list.id'))
                 ->from('use_list')
                 ->join('list', 'use_list.id_list = list.id')
                 ->join('user', 'user.id = list.id_user')
                 ->where('login = "'.$login.'"')
                 ->get();

            $id_lists[]= $query->result();
        }
        return $id_lists[0];
    }

    public function getProductsInShop(int $id_list, int $id_shop)
    {
        $this->db->select(array('product.id', 'name', 'amount', 'checked', 'weight', 'coldness'))
               ->from('use_list_product')
               ->join('shop_product', 'shop_product.id_product = use_list_product.id_product')
               ->join('product', 'use_list_product.id_product = product.id')
               ->where('shop_product.id_shop = '.$id_shop)
               ->where('use_list_product.id_list = '.$id_list);

        $results = $this->db->get()->result();
        return $results;
    }

    public function isStarted(int $id_list)
    {
        $result = $this->db->get_where('use_list', array('id_list' => $id_list));

        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getSessionId(int $id_list)
    {
        $result = $this->db->get_where('use_list', array('id_list' => $id_list));

        return $result->result()[0]->id;
    }
}
