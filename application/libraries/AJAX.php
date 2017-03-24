<?php  if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class AJAX
{
    public function __construct()
    {
        $this->response = array();
        $this->response['data'] = array();
        $this->response['errors']= array();
        $this->response['status']= array();

        $this->response = (object)$this->response;

        $this->response->data = array();
        $this->response->errors = array();
        $this->response->status = true;
    }


    public function addData($name, $content)
    {
        $this->response->data[$name] = $content;
    }

    public function addError($message)
    {
        $this->response->status = false;
        $this->response->errors[] = $message;
    }


    public function send()
    {
        echo json_encode($this->response);
    }
}
