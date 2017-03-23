<?php
include_once('Core.php');

class Home extends Core_Controller {

    public function __construct() {
           parent::__construct();
           $this->load->model('user_model');
   }

   /** @brief Displays the home page
   *
   *
   *
   */
   public function index() {
       $this->logged_user_only();
           #PAGE REGROUPANT DERNIERE INFOS
           #liste
           #notification
           $data = array();
           $this->smarty->view('Home/index.tpl', $data);
   }

   /** Displays the profile page
   *
   * @detail Displays the profile information of the logged user, and a
   *         form to change the account password. If the form is completed
   *         correctly it will call change_pwd($login, $new_password) from
   *         user_model.
   */
   public function profil() {
       $this->logged_user_only();
           $data = array();
           $this->load->helper('form');
           $this->load->library('form_validation');

           $this->form_validation->set_rules('old_password', 'ancien mot de passe', 'required|callback_password_check');
           $this->form_validation->set_rules('new_password', 'nouveau mot de passe', 'required');
           $this->form_validation->set_rules('new_password_conf', 'confirmation du nouveau mot de passe', 'required|matches[new_password]');

           if ($this->form_validation->run() == TRUE) {
               $this->user_model->change_pwd($this->session->userdata('login'), $this->input->post('new_password'));
               $this->session->set_flashdata('password_changed', true);
           }

           $data = $this->user_model->info($this->session->userdata('login'));
           $this->smarty->view('Home/profil.tpl', $data);

   }

   /** Displays the friends page
   *
   * @detail Displays the list of friends of the logged user, and a form
   *         to add a friend. This form will call add_friend($login, $friend_login)
   *         from user_model.
   */
   public function amis() {
       $this->logged_user_only();

           $data = array();
           $this->load->helper('form');
           $this->load->library('form_validation');

               $this->form_validation->set_rules('ami_login', 'login_ami', 'required|callback_login_check');

           if ($this->form_validation->run() == TRUE) {
               $this->user_model->add_friend($this->session->userdata('login'), $this->input->post('ami_login'));
               $this->session->set_flashdata('new_ami',  $this->input->post('ami_login'));
           }

           $data['amis'] = $this->user_model->get_friends($this->session->userdata('login'), TRUE);
           $data['notifications'] = $this->user_model->get_notifications($this->session->userdata('login'));

           $data['friend_list'] = $this->user_model->get_friend_list($this->session->userdata('id'));


           $this->smarty->view('Home/ami.tpl',$data);
   }



   /** @brief Disconnects the user and redirects to connexion page
   *
   */
   public function logout() {
       $this->logged_user_only();
           $this->session->unset_userdata('logged_in');
           $this->session->unset_userdata('logged_admin');
           $this->session->unset_userdata('login');
           $this->session->unset_userdata('id');
           redirect('accueil/connexion','refresh');
   }


   /** @brief Verifies if the provided password is correct
   *
   * @detail Calls valid_connexion_info($login, $str) from user_model
   *
   * @param $str - The password typed by the user
   *
   * @return Boolean : returns TRUE if the password is valid, FALSE if
   *                   it is not
   */
   public function password_check($str) {
       if ($this->user_model->valid_connexion_info($this->session->userdata('login'), $str) == TRUE) {
           return TRUE;
       } else {
           $this->form_validation->set_message('password_check', 'Le mot actuel n\'est pas reconnu.');
           return FALSE;
       }
   }

   /** @brief Verifies if the provided login is correct
   *
   *  @detail When the user tries to add a friend, verifies if the login
   *          he typed is correct (not his login, not already friends,
   *          existing login, no invitation already sent to this login).
   *          Calls login_exists($str) and are_friends($str, $login) from
   *          user_model.
   *
   * @param $str - The login typed by the user
   *
   * @return Boolean : returns TRUE if the type login is valid, else returns FALSE
   */
   public function login_check($str) {
       if ($str == $this->session->userdata('login')) {
           $this->form_validation->set_message('login_check', 'Vous ne pouvez pas vous ajouter vous-même.');
            return FALSE;
       }

       if ($this->user_model->login_exists($str) == FALSE ) {
           $this->form_validation->set_message('login_check', 'Ce login n\'a pas été trouvé.');
           return FALSE;
       }

       $ami =  $this->user_model->are_friends($str, $this->session->userdata('id'));
       if ($ami == 'access') {
           $this->form_validation->set_message('login_check', 'Vous êtes déjà ami avec cette personne');
           return FALSE;
       } elseif($ami == 'waiting') {
            $this->form_validation->set_message('login_check', 'Une invitation a déjà été envoyée.');
           return FALSE;
       }


       return TRUE;
   }


   /** @brief Adds a friend to the logged user friend list from a notification
   *
   * @detail Checks if the user has notifications. If he has, he can choose
   *         to accept or to delete them
   *
   */
   public function ajouterami() {
       $this->logged_user_only();

       if ( in_array(
           $this->input->get('login'),
           $this->user_model->get_notifications($this->session->userdata('login'))
           ) == TRUE ) {

           if ($this->input->get('etat') == 'accepte') {
               $this->user_model->add_friend($this->input->get('login'), $this->session->userdata('login'), $this->input->get('etat'));
           } elseif($this->input->get('etat') == 'refuser') {
               $this->user_model->delete_friend($this->input->get('login'), $this->session->userdata('login'));
           }

       } else {
           $this->session->set_flashdata('error','Une erreur à eue lieu lors de l\'ajout d\'un ami');
       }


       redirect('home/amis', 'refresh');
   }

   /** @brief Deletes a friend from the logged user friend list
   *
   * @detail Checks if the logged user and the friend to be deleted
   *         actually are friends (calls are_friends($login, $id) from user_model).
   *         If they are, deletes the friend (calls delete_friend($login1, $login2) from user_model).
   *         Refreshes the page.
   */
   public function supprimerami() {
       $this->logged_user_only();

       if ( $this->user_model->are_friends($this->input->get('login'),$this->session->userdata('id')) == TRUE ) {
              $this->user_model->delete_friend($this->input->get('login'), $this->session->userdata('login'), $this->input->get('etat'));
       } else {
           $this->session->set_flashdata('error','Une erreur à eue lieu lors de la suppression d\'un ami');
       }

       redirect('home/amis', 'refresh');
   }

}
