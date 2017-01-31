<?php

class Ajax extends CI_Controller {

    public function __construct() {
           parent::__construct();
           $this->load->model('utilisateurs_model');
   }


   public function index() {

      $this->smarty->view('Ajax/index.tpl', array());
   }

   public function test() {
       $response = $this->utilisateurs_model->getUsers();
       echo json_encode($response);
   }

   public function test_message() {


       if ($this->input->post('message') == "")
            $response = "No message :/";
       else
            $response = $this->input->post('message');

        echo $response;
    }

    public function user() {


        if ($this->input->post('user') == "")
            $response['error'] = 'no user';
        else
            $response = $this->utilisateurs_model->getUser($this->input->post('user'))->result();

        var_dump($response);
        //echo json_encode($response);
    }

}
