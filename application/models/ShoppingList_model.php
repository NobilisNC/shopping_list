<?php

class ShoppingList_model extends CI_Model {

    public function __construct() {
            $this->load->database();
    }

    /** @brief Creates an empty list for a specified user
     *
     * @param $id_user - A specified user's id
     */
    public function createEmptyList(int $id_user) {
      $data = array(
          'name' => 'Empty List',
          'date' => date('Y/m/d'),
          'id_user' => $id_user
      );
      ///@todo - Doit renvoyer un booléen
     return $this->db->insert('list', $data);

    }

    /** @brief Delete a list with a specified id
     *
     * @param $id_list - A specified list id
     */
    public function deleteList(int $id_list) {
      $this->db->delete('list', array( 'id' => $id_list));
    }

    /** @brief Get all lists of a specified user id
     *
     * @param $id - A specified user's id
     *
     * @return All lists for this specified user
     */
    public function getLists(int $id){
      $query = $this->db->get_where('list', array('id_user' => $id));

      return $query->result();

    }

    /** @brief Get a list by giving it id
     *
     * @param $id - A specified list id
     *
     *@return The list
     */
    public function getListById(int $id) {
      $query = $this->db->get_where('list', array('id' => $id));
      return $query->result()[0];
    }

    /** @brief Set name of a specified list
     *
     * @param $id - A specified list id
     * @param $name - The new name of the list
     */
    public function setName(int $id, string $name) {
      $data = array (
        'name' => $name
      );

        $this->db->where('id', $id);
        $this->db->update('list', $data );
    }

    /** @brief Return products of a specified list
     *
     * @param $id_list - A specified list id
     *
     * @return All the products in the list
     */
    public function getProducts(int $id_list) {
        $this->db->select('name, amount, id')
                 ->from('product')
                 ->join('list_product', 'list_product.id_product = product.id')
                 ->where('list_product.id_list = '.$id_list);

        $query = $this->db->get();
        return $query->result();
    }

    /** @brief Return names of products giving only the first letters
     *         Used from Ajax request
     *
     * @param $name - The beginning of a product name
     *
     * @return All product names that start with $name
     */
    public function getProductsLike(string $name) {
        $this->db->select('id, name')
                 ->from('product')
                 ->where("name LIKE '".$name."%'")
                 ->order_by('name', 'asc');

        $query = $this->db->get();

        return $query->result();
      }

      /** @brief Adds a product to a specified list
       *
       * @param $id_list - A specified list id
       * @param $id_product - The id of the product to add
       *
       * @return Boolean : True if the product is added, false if it is not.
       */
      public function addProductToList(int $id_list, string $id_product ) {

           $data = array(
             'id_list' => $id_list,
             'id_product' => $id_product,
             'amount' => 1
           );

           $this->db->insert('list_product', $data);
           return true;
      }

      /** @brief Deletes a product for a specified list
       *
       * @param $id_list - A specified list id
       * @param $id_product - The id of the product to add
       *
       * @return Boolean : True if the product is deleted, false if it is not.
       */
      public function deleteProductFromList(int $id_list, int $id_product) {
          $this->db->where(array('id_list' => $id_list, 'id_product' => $id_product))
                   ->delete('list_product');
          return true;
      }

      /** @brief Gets a product by its id
       *
       * @param $id_prod - A specified product id
       *
       * @return The product corresponding to the given id
       */
      public function getProductById(int $id_prod) {
        return $this->db->get_where('product', array('id' => $id_prod))->result()[0];
      }


      /** @brief Sets the amount of a specified product in a specified list
       *
       * @param $id_list - A specified list id
       * @param $id_product - A specified product id
       * @param $amount - The amount of product we want to set
       *
       * @return Boolean : TRUE if the amount is set, FALSE if it is not
       */
        public function setAmount(int $id_list, int $id_product, int $amount) {
          $this->db->set('amount', $amount)
                   ->where('id_list', $id_list)
                   ->where('id_product', $id_product)
                   ->update('list_product');

          return true;
        }

        /** @brief Gets the amount of a specified product in a specified list
         *
         * @param $id_list - A specified list id
         * @param $id_product - A specified product id
         *
         * @return : The amount of the specified product in this list
         */
          public function getAmount(int $id_list, int $id_product) {
            return $this->db->select('amount')
                            ->from('list_product')
                            ->where('id_product', $id_product)
                            ->where('id_list', $id_list)
                            ->get()->result()[0]->amount;
          }


        /** @brief Updates note in a specified list
         *
         * @param $id_list - A specified list id
         * @param $note - The new note for this list
         */
      public function updateNote(int $id_list, string $note) {
        $this->db->set('note', $note)
                 ->where('id', $id_list)
                 ->update('list');
      }

      public function isOwner(int $id_list, int $id_user) {
        $result = $this->db->get_where('list', array('id' => $id_list, 'id_user' => $id_user));

        if($result->num_rows() > 0)
          return true;
        else
          return false;
      }
}
