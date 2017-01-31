<?php
include_once('Core.php');

class Home extends Core_Controller {

    public function __construct() {
           parent::__construct();
           $this->load->model('user_model');
   }

   public function index() {
       $this->logged_user_only();
           #PAGE REGROUPANT DERNIERE INFOS
           #liste
           #notification
           $data = array();
           $this->smarty->view('Home/index.tpl', $data);

   }

   public function profil() {
       $this->logged_user_only();
           $data = array();
           $this->load->helper('form');
           $this->load->library('form_validation');

           $this->form_validation->set_rules('old_password', 'ancien mot de passe', 'required|callback_password_check');
           $this->form_validation->set_rules('new_password', 'nouveau mot de passe', 'required');
           $this->form_validation->set_rules('new_password_conf', 'confirmation du nouveau mot de passe', 'required|matches[new_password]');

           if ($this->form_validation->run() == TRUE) {
               $this->user_model->modifier_mdp($this->session->userdata('login'), $this->input->post('new_password'));
               $this->session->set_flashdata('password_changed', true);
           }

           $data = $this->user_model->infos($this->session->userdata('login'));
           $this->smarty->view('Home/profil.tpl', $data);

   }


   public function amis() {
       $this->logged_user_only();

           $data = array();
           $this->load->helper('form');
           $this->load->library('form_validation');

               $this->form_validation->set_rules('ami_login', 'login_ami', 'required|callback_login_check');

           if ($this->form_validation->run() == TRUE) {
               $this->user_model->ajouter_ami($this->session->userdata('login'), $this->input->post('ami_login'));
               $this->session->set_flashdata('new_ami',  $this->input->post('ami_login'));
           }

           $data['amis'] = $this->user_model->obtenir_amis($this->session->userdata('login'), TRUE);
           $data['notifications'] = $this->user_model->obtenir_notifications($this->session->userdata('login'));
           $this->smarty->view('Home/ami.tpl',$data);
   }




   public function logout() {
       $this->logged_user_only();
           $this->session->unset_userdata('logged_in');
           $this->session->unset_userdata('login');
           $this->session->unset_userdata('id');
           redirect('accueil/connexion','refresh');
   }


   public function password_check($str) {
       if ($this->user_model->valid_infos_connexion($this->session->userdata('login'), $str) == TRUE) {
           return TRUE;
       } else {
           $this->form_validation->set_message('password_check', 'Le mot actuel n\'est pas reconnu.');
           return FALSE;
       }
   }

   public function login_check($str) {
       if ($str == $this->session->userdata('login')) {
           $this->form_validation->set_message('login_check', 'Vous ne pouvez pas vous ajouter vous-même.');
            return FALSE;
       }

       $ami =  $this->user_model->sont_amis($str, $this->session->userdata('login'));
       if ($ami == 'accepte') {
           $this->form_validation->set_message('login_check', 'Vous êtes déjà amis avec cette personne');
           return FALSE;
       } elseif($ami == 'attente') {
            $this->form_validation->set_message('login_check', 'Une invitation a déjà été envoyée.');
           return FALSE;
       }

       if ($this->user_model->login_existe($str) == TRUE ) {
           return TRUE;
       } else {
           $this->form_validation->set_message('login_check', 'Ce login n\'a pas était trouvé.');
           return FALSE;
       }
   }

   public function ajouterami() {
       $this->logged_user_only();

       if ( in_array(
           $this->input->get('login'),
           $this->user_model->obtenir_notifications($this->session->userdata('login'))
           ) == TRUE ) {

           if ($this->input->get('etat') == 'accepte') {
               $this->user_model->ajouter_ami($this->input->get('login'), $this->session->userdata('login'), $this->input->get('etat'));
           } elseif($this->input->get('etat') == 'refuser') {
               $this->user_model->supprimer_ami($this->input->get('login'), $this->session->userdata('login'));
           }

       } else {
           $this->session->set_flashdata('error','Une erreur à eue lieu lors de l\'ajout d\'un ami');
       }


       redirect('home/amis', 'refresh');
   }

   public function supprimerami() {
       $this->logged_user_only();

       if ( $this->user_model->sont_amis($this->input->get('login'),$this->session->userdata('login')) == TRUE ) {
              $this->user_model->supprimer_ami($this->input->get('login'), $this->session->userdata('login'), $this->input->get('etat'));
       } else {
           $this->session->set_flashdata('error','Une erreur à eue lieu lors de la suppression d\'un ami');
       }

       redirect('home/amis', 'refresh');
   }

}
