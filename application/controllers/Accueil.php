<?php

class Accueil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

   /** @brief Displays home page
    *
    * @todo A faire
    */
   public function index()
   {
       $data = array();
       $this->smarty->view('Accueil/accueil.tpl', $data);
   }

   /** @brief Displays login page
    *
    * @detail Diplays login form, login button and a button to redirect
    *         an unregistered user to inscription page.
    */
   public function connexion()
   {
       $data = array();
       $data['inscription_success'] = $this->session->flashdata('inscription_success');
       $data['not_logged'] = $this->session->flashdata('not_logged');
       $this->load->helper('form');
       $this->load->library('form_validation');

       $this->form_validation->set_rules('login', 'login', 'required|callback_verify_connexion_info');
       $this->form_validation->set_rules('password', 'mot de passe', 'required');

       if ($this->form_validation->run() == true) {
           $this->session->set_userdata('logged_in', true);
           $this->session->set_userdata('login', $this->input->post('login'));
           $this->session->set_userdata('id', $this->user_model->id($this->session->userdata('login')));
           //Verification si l utilisateur est administrateur
           $isAdmin = $this->verify_admin_rights($this->session->userdata('id'));
           if ($isAdmin == true) {
               $this->session->set_userdata('logged_admin', true);
           }
           if ($this->session->userdata('id') == 1) {
               $this->session->set_userdata('logged_super_user', true);
           }
           redirect('home/index', 'refresh');
       } else {
           $this->smarty->view('Accueil/connexion.tpl', $data);
       }
   }

   /** @brief Displays inscription page
    *
    * @detail Displays insription form, validation button, clear button
    *         and a redirection to login page button
    *         Calls addUser($user_data) from user_model if the form is
    *         correctly completed
    */
   public function inscription()
   {
       $data = array();
       $this->load->helper('form');
       $this->load->library('form_validation');

       $this->form_validation->set_rules('login', 'login', 'required|callback_login_check');
       $this->form_validation->set_rules('nom', 'nom', 'required');
       $this->form_validation->set_rules('prenom', 'prénom', 'required');
       $this->form_validation->set_rules('mail', 'adresse mail', 'required|valid_email|callback_email_check');
       $this->form_validation->set_rules('password', 'mot de passe', 'required|sha1');
       $this->form_validation->set_rules('password_conf', 'confirmation du mot de passe', 'required|matches[password]|sha1');

       if ($this->form_validation->run() == true) {
           $user_data = array(
               'login' =>  $this->input->post('login'),
               'password' => $this->input->post('password'),
               'mail' => $this->input->post('mail'),
               'name' => $this->input->post('nom'),
               'fname' => $this->input->post('prenom')
           );
           $this->session->set_flashdata('inscription_success', $this->user_model->addUser($user_data));
           redirect('accueil/connexion', 'refresh');
       } else {
           $this->smarty->view('Accueil/inscription.tpl', $data);
       }
   }

   /** @brief Verifies if the provided login is already used
    *
    * @detail Calls login_exists($str)
    *
    * @param $str - the login you check
    *
    * @return Boolean : TRUE if the login is valid (isn't already used),
    *                   FALSE if the login isn't valid (already used)
    */
   public function login_check($str)
   {
       if ($this->user_model->login_exists($str) == true) {
           $this->form_validation->set_message('login_check', 'Ce {field} existe déjà.');
           return false;
       } else {
           return true;
       }
   }

   /** @brief Verifies if the provided email is already used
    *
    * @detail Calls email_exists($str) from user_model
    *
    * @param $str - The email you check
    *
    * @return Boolean : TRUE if the email is valid (isn't already used),
    *                   FALSE if the email isn't valid (already used)
    */
   public function email_check($str)
   {
       if ($this->user_model->email_exists($str) == true) {
           $this->form_validation->set_message('email_check', 'Cet {field} est déjà associée.');
           return false;
       } else {
           return true;
       }
   }


   /** @brief Verifies if the provided connexion information is valid
   *
   * @detail Calls valid_connexion_info($login, $password) from user_model
   *        to check if it matches the database.
   *
   * @param $str ?
   *
   * @return Boolean : TRUE if the information is valid, FALSE if it isn't.
   */
   public function verify_connexion_info($str)
   {
       if ($this->user_model->valid_connexion_info($this->input->post('login'), $this->input->post('password')) == true) {
           return true;
       } else {
           $this->form_validation->set_message('verify_connexion_info', 'Pseudo/mot de passe non trouvés.');
           return false;
       }
   }

   /** @ Verifies if the specified user is an admin
   *
   * @detail Calls valid_admin_rights($id) from user_model
   *
   * @param $id - A specified user id
   *
   * @return Boolean : returns TRUE if the user is an admin, else returns FALSE
   */
   public function verify_admin_rights(int $id)
   {
       if ($this->user_model->valid_admin_rights($id) == true) {
           return true;
       } else {
           return false;
       }
   }
}
