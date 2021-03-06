<?php

class Core_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

   /** @ brief Checks if the user is logged
   *
   * @detail If the user isn't logged, redirects to login page
   */
   protected function logged_user_only()
   {
       if ($this->session->userdata('logged_in') !== true) {
           $this->session->set_flashdata('not_logged', '');
           redirect('accueil/connexion');
       }
   }

   /** @brief Checks if the user is admin
   *
   * @detail If the user isn't admin, redirects to home page
   */
   protected function admin_user_only()
   {
       if ($this->session->userdata('logged_admin') !== true) {
           $this->session->set_flashdata('not_admin', '');
           redirect('accueil/index');
       }
   }

   /** @brief Checks if the user is the super admin
   *
   * @detail If the user isn't super admin, redirects to home page
   */
    protected function super_user_only()
    {
        if ($this->session->userdata('id') != 1) {
            $this->session->set_flashdata('not_super_user', '');
            redirect('accueil/index');
        }
    }
}
