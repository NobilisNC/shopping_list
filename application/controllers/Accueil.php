<?php

class Accueil extends CI_Controller {

    public function __construct() {
           parent::__construct();
           $this->load->model('utilisateurs_model');
   }

   public function index() {
       $data = array();
       $this->smarty->view( 'Accueil/accueil.tpl', $data );
   }

   public function connexion() {
       $data = array();
       $data['inscription_success'] = $this->session->flashdata('inscription_success');
       $data['not_logged'] = $this->session->flashdata('not_logged');
       $this->load->helper('form');
       $this->load->library('form_validation');

       $this->form_validation->set_rules('login', 'login', 'required|callback_verifier_infos_connexion');
       $this->form_validation->set_rules('password', 'mot de passe', 'required');

       if ($this->form_validation->run() == TRUE) {
           $this->session->set_userdata('logged_in', TRUE);
           $this->session->set_userdata('login', $this->input->post('login'));
           redirect('home/index','refresh');
       } else {
           $this->smarty->view('Accueil/connexion.tpl', $data);
       }
   }

   public function inscription() {
       $data = array();
       $this->load->helper('form');
       $this->load->library('form_validation');

       $this->form_validation->set_rules('login', 'login', 'required|callback_login_check');
       $this->form_validation->set_rules('nom', 'nom', 'required');
       $this->form_validation->set_rules('prenom', 'prénom', 'required');
       $this->form_validation->set_rules('mail', 'adresse mail', 'required|valid_email|callback_email_check');
       $this->form_validation->set_rules('password', 'mot de passe', 'required|sha1');
       $this->form_validation->set_rules('password_conf', 'confirmation du mot de passe', 'required|matches[password]|sha1');

       if ($this->form_validation->run() == TRUE) {
           $user_data = array(
               'login' =>  $this->input->post('login'),
               'password' => $this->input->post('password'),
               'mail' => $this->input->post('mail'),
               'nom' => $this->input->post('nom'),
               'prenom' => $this->input->post('prenom')
           );
           $this->session->set_flashdata('inscription_success', $this->utilisateurs_model->ajouter_Utilisateur($user_data));
           redirect('accueil/connexion', 'refresh');
       } else {
           $this->smarty->view('Accueil/inscription.tpl', $data);
       }

   }

   public function login_check($str) {
       if ($this->utilisateurs_model->valid_login($str) == TRUE) {
           return TRUE;
       } else {
           $this->form_validation->set_message('login_check', 'Ce {field} existe déjà.');
           return FALSE;
       }
   }

   public function email_check($str) {
       if ($this->utilisateurs_model->valid_email($str) == TRUE) {
           return TRUE;
       } else {
           $this->form_validation->set_message('email_check', 'Cette {field} est déjà associée.');
           return FALSE;
       }
   }

   public function verifier_infos_connexion($str) {

       if ($this->utilisateurs_model->valid_infos_connexion( $this->input->post('login'), $this->input->post('password') ) == TRUE) {
           return TRUE;
       } else {
           $this->form_validation->set_message('verifier_infos_connexion', 'Pseudo/mot de passe non trouvés.');
           return FALSE;
       }

   }


}
