<?php

class Client extends Controller{
    public $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('Adress');
    }
    public function home() {
        $data = [
            'title' => 'You Welcomee to Our dashboard Client',
        ];
        
        $this->view('client/home' , $data );
    }
}