<?php
class Accueil extends CI_Controller {

    public function __construct() {
           parent::__construct();
           $this->load->model('accueil_model');
           $this->load->model('utilisateurs_model');
   }

   public function index() {
       $data = array();
       $this->smarty->view( 'Accueil/accueil.tpl', $data );
   }

   public function connexion() {
       $data = array();
       $this->smarty->view( 'Accueil/connexion.tpl', $data );
   }

   public function inscription() {
       $data = array();
       $this->load->helper('form');
       $this->load->library('form_validation');

       $this->form_validation->set_rules('login', 'login', 'required|callback_login_check');
       $this->form_validation->set_rules('nom', 'nom', 'required');
       $this->form_validation->set_rules('prenom', 'prénom', 'required');
       $this->form_validation->set_rules('mail', 'adresse mail', 'required|valid_email|callback_email_check');
       $this->form_validation->set_rules('password', 'mot de passe', 'required');
       $this->form_validation->set_rules('password_conf', 'confirmation du mot de passe', 'required|matches[password]');

       if ($this->form_validation->run() == TRUE) {
           $data['inscription_success'] = $this->utilisateurs_model->ajouter_Utilisateur();
           $this->smarty->view('Accueil/accueil.tpl', $data);
       } else {
           $this->smarty->view('Accueil/inscription.tpl', $data);
       }

   }

   public function login_check($str) {
       if ($this->accueil_model->valid_login($str) == TRUE) {
           return TRUE;
       } else {
           $this->form_validation->set_message('login_check', 'Ce {field} existe déjà.');
           return FALSE;
       }
   }

   public function email_check($str) {
       if ($this->accueil_model->valid_email($str) == TRUE) {
           return TRUE;
       } else {
           $this->form_validation->set_message('email_check', 'Cette {field} est déjà associée.');
           return FALSE;
       }

   }


}
