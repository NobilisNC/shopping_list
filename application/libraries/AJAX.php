<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


/*
  $response = new AJAX();
  $response->setError('Not logged');
  $respnse->addData('user', array['name' => 'caca', 'aaa'=> 'aaa']);
  $response -> send();
*/


class AJAX {

  function __construct() {
    $this->response = array();
    $this->response['data'] = array();
    $this->response['errors']= array();

    $this->response = (object)$this->response;

    $this->response->data = array();
    $this->response->errors['numbers'] = 0;

    $this->error = false;
  }

  static function get() {
      //var_dump(CI_input::raw_input_stream());

  }

  static function post() {
    var_dump($_POST);
  }

  function addData($name, $content) {
    $this->response->data[$name] = $content;
  }

  function setError($message) {
    $this->error = true;
    $this->response->errors['numbers'] += 1;
    $this->response->errors[] = $message;
  }


  function send() {
    echo json_encode($this->response);
  }

}
