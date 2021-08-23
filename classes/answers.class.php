<?php

class Answers{
    private $response = [
        'status' => 'ok',
        'result' => array()
    ];

    public function error_450(){
        $this->response['status'] = 'error';
        $this->response['result'] = array(
          'error_id' => '405',
          'error_msg' => 'No allowed method'
        );
        return $this->response;
    }

    public function error_200($string = "Wrong data"){
        $this->response['status'] = 'error';
        $this->response['result'] = array(
            'error_id' => '200',
            'error_msg' => $string
        );
        return $this->response;
    }

    public function error_400(){
        $this->response['status'] = 'error';
        $this->response['result'] = array(
            'error_id' => '400',
            'error_msg' => 'incomplete or incorrectly formatted data submitted'
        );
        return $this->response;
    }

}
