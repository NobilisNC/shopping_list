<?php

class Core_Controller extends CI_Controller {

    public function __construct() {
           parent::__construct();
   }

   protected function logged_user_only() {
       if ($this->session->userdata('logged_in') !== TRUE) {
           $this->session->set_flashdata('not_logged','');
           redirect('accueil/connexion');
       }
   }

}
