<?php 

class Users extends Controller {

    public function __construct()
    {
        // $this->userModel = $this->model('User');
    }

    public function register() {

        $data = [
            'title' => 'Hello Am from Register'
        ];


        $this->view('users/register', $data);
    }

    public function dashboard() {

        $data = [
            'title' => 'hi am index in Dashboard Users',

        ];
        
        $this->view('users/index' , $data );
    }




}










?>