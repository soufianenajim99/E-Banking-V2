<?php

    require_once APPROOT . '/helpers/regex.php';
    require_once APPROOT . '/security/LoginService.php';


    class Pages extends Controller{
        public $userModel;
        public function __construct()
        {

        }
        public function index() {

            $data = [
                'title' => 'You Welcomee to Our Website',

            ];
            
            $this->view('pages/index' , $data );
        }
        // page About
        public function about() {
            $data = [
                'title' => 'About us' 
            ];
            $this->view('pages/about' , $data);
        }
        // ================== LOGIN PAGE =======================
        public function login() {

            if(isset($_POST['login'])) {
                $data = [
                    'username' => $_POST['username'],
                    'password' => $_POST['password'],
                    'loginErr' => '',
                    'roleofuser' => '',
                    'userErr' => '',
                    'passErr' => ''
    
                ];
                if (empty($data['username'])) {
                    $data['userErr'] = 'Please Enter your username';
                }else{
                    if (!validateUsername($data['username'])) {
                        $data['userErr'] = 'Please Enter Validate username';
                    }else {
                        $data['userErr'] = '';
                    }   
                }
                if (empty($data['password'])) {
                    $data['passErr'] = 'Please Enter your password';
                }else{
                    if (!validatePw($data['password'])) {
                        $data['passErr'] = 'Please Enter Validate password';
                    }else {
                        $data['passErr'] = '';
                    }
                    
                }
                if (empty($data['userErr']) && empty($data['passErr'])) {
                    $loginService = new LoginService();
                    $fetch = $loginService->fetchUserByUsernameAndPass($data['username'] , $data['password']);
                    
                    if (!$fetch) {
                    $data['loginErr'] = "Incorrect username and password";
                    $this->view('pages/login' , $data);
                    }else {
                    // empty Login Error 
                    $data['loginErr'] = "";
                    $roleOfUser = $loginService->getRoleOfUSer($fetch->userID);
                    if ($roleOfUser->roleName === 'admin') {
                        $_SESSION['username'] = $fetch->username;
                        $_SESSION['rolename'] = $roleOfUser->roleName;
                        header('Location:' . URLROOT . '/admin/home');
                    }else {
                        $_SESSION['username'] = $fetch->username;
                        $_SESSION['rolename'] = $roleOfUser->roleName;
                        header('Location:' . URLROOT . '/client/home');
                    }

                    }
                    
                    

                }else {

                    $this->view('pages/login' , $data);
                }              
            }else {

                $data = [
                    'username' => '',
                    'password' => '',
                    'loginErr' => '',
                    'roleofuser' => '',
                    'userErr' => '',
                    'passErr' => ''
    
                ];
                    $this->view('pages/login' , $data);

            }
            
            



        }

        public function logout() {
            
            session_unset();
            session_destroy();
            header('Location:' . URLROOT . '/pages/login');

        }
    }