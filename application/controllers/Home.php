<?php

class Home extends CI_Controller {

    public function __construct() {
           parent::__construct();
           $this->load->model('utilisateurs_model');
   }

   public function index() {
       if ($this->estConnecte()) {
           #PAGE REGROUPANT DERNIERE INFOS
           #liste
           #notification
           $data = array();
           $this->smarty->view('Home/index.tpl', $data);
       }
   }

   public function profil() {
       if($this->estConnecte()){
           $data = array();
           $this->load->helper('form');
           $this->load->library('form_validation');

           $this->form_validation->set_rules('old_password', 'ancien mot de passe', 'required|callback_password_check');
           $this->form_validation->set_rules('new_password', 'nouveau mot de passe', 'required');
           $this->form_validation->set_rules('new_password_conf', 'confirmation du nouveau mot de passe', 'required|matches[new_password]');

           if ($this->form_validation->run() == TRUE) {
               $this->utilisateurs_model->modifier_mdp($this->session->userdata('login'), $this->input->post('new_password'));
               $this->session->set_flashdata('password_changed', true);
           }

           $data = $this->utilisateurs_model->infos($this->session->userdata('login'));
           $this->smarty->view('Home/profil.tpl', $data);
        }
   }

   public function logout() {
       if($this->estConnecte()){
           $this->session->unset_userdata('logged_in');
           $this->session->unset_userdata('login');
           redirect('accueil/connexion','refresh');
        }
   }

   private function estConnecte() {
       if ($this->session->userdata('logged_in') !== TRUE) {
           $this->session->set_flashdata('not_logged','');
           redirect('accueil/connexion');
           return FALSE;
       } else {
            return TRUE;
        }
   }

   public function password_check($str) {
       if ($this->utilisateurs_model->valid_infos_connexion($this->session->userdata('login'), $str) == TRUE) {
           return TRUE;
       } else {
           $this->form_validation->set_message('password_check', 'Le mot actuel n\'est pas reconnu.');
           return FALSE;
       }

   }

}
