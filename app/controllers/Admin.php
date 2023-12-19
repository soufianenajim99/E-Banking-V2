<?php

class Admin extends Controller{
    private $bankService;
    private $agencyService;
    private $userService;

    public function __construct()
    {
        $this->bankService = new Bservice();
        $this->agencyService = new AgencyService();
        $this->userService = new Uservice();
        // $this->userModel = $this->model('Adress');
    }
    public function home() {
        
        // Check If is Admin Or Not 
        if (isset($_SESSION['rolename'])) {
            if ($_SESSION['rolename'] != 'admin') {
                header('Location:' . URLROOT . '/client/home');
            }
        }else {
            header('Location:' . URLROOT . '/pages/index');
        }
        // End Check  

        // Data Transfer To view;
        $data = [
            'title' => 'You Welcomee to Our dashboard Admin',
            'page' => 'home'
        ];
        
        $this->view('admin/home' , $data );
    }
    // B===================== BANK ========================
    public function bank() {
        // Check If is Admin Or Not 
        if (isset($_SESSION['rolename'])) {
            if ($_SESSION['rolename'] != 'admin') {
                header('Location:' . URLROOT . '/client/home');
            }
        }else {
            header('Location:' . URLROOT . '/pages/index');
        }
        // End Check
        $banks = $this->bankService->getAllBanks();

        // Data Transfer To view;
        $data = [
            'banks' => $banks,
            'page' => 'bank'
        ];
        
        $this->view('admin/bank' , $data );
    }

    
    // =================== ADD bank ====================
    public function addBank() {
        // Check If is Admin Or Not 
        if (isset($_SESSION['rolename'])) {
            if ($_SESSION['rolename'] != 'admin') {
                header('Location:' . URLROOT . '/client/home');
            }
        }else {
            header('Location:' . URLROOT . '/pages/index');
        }
        // End Check  
        // Check Validation

        if (isset($_POST['bank'])) {

            $data = [
                'bankname' => $_POST['bankname'],
                'logo' => $_FILES['logo'],  
                'bankNameErr' =>'',
                'imgBankErr' =>'',
                'page' => 'bank'
            ];
            if (empty($data['bankname'])){
                $data['bankNameErr'] = 'Please Enter bank name';
            }else {
                $data['bankNameErr'] = '';

            }
            if (empty($data['logo']['name'])){
                $data['imgBankErr'] = 'Please Upload images';
            }else {
                $data['imgBankErr'] = '';
                

            }
            if (empty($data['bankNameErr']) && empty($data['imgBankErr'])) {
                $imgStore = $_SERVER["DOCUMENT_ROOT"]."/bank-mvc/public/img/uploads/";

                // Field Is Correct Add new Bank Here 
                
                $fileName = basename($_FILES["logo"]["name"]);
                $placement = $imgStore.$fileName;
                $fileType = pathinfo($placement,PATHINFO_EXTENSION);

                $correctExt =  array("jpg","png","jpeg");

                if (in_array($fileType , $correctExt)) {
                    if (move_uploaded_file($_FILES['logo']['tmp_name'], $placement)) {
                        $newBank = new Bank();
                        $newBank->setBankID(uniqid());
                        $newBank->setBankName($data['bankname']);
                        $newBank->setBankLogo($fileName);
                        try {
                            $this->bankService->addBank($newBank);
                            header('Location:' . URLROOT . '/admin/bank');
                        } catch (PDOException $e) {
                            die('Failed to add bank' . $e->getMessage());
                        } 
                    }else {
                        die("Failed to Uplaod images");
                    }
                }else {
                    $data['imgBankErr'] = "Only JPG,JPEG OR PNG";
                    $this->view('admin/addbank' , $data );
                } 
            }else{
                $this->view('admin/addbank' , $data );
                
            }
 
        }
        // Data Transfer To view;

        $data = [
            'bankname' => '',
            'logo' => '',
            'bankNameErr' => '',
            'imgBankErr' =>'',
            'page' => 'bank'
        ];
        
        $this->view('admin/addbank' , $data );
    }
    // ================ Delete BANK =============
    public function deleteBank() {
        $bankID = $_GET['id'];

        $this->bankService->deleteBank($bankID);
        header('Location:' . URLROOT . '/admin/bank');


        // $this->view('admin/deleteBank');
    }
    // ================ Update  BANK =============
    public function updateBank() {

        if (isset($_SESSION['rolename'])) {
            if ($_SESSION['rolename'] != 'admin') {
                header('Location:' . URLROOT . '/client/home');
            }
        }else {
            header('Location:' . URLROOT . '/pages/index');
        }

       if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $bankID = $_GET['id'];
        $data =  [

            'bankNameErr' =>'',
            'imgBankErr' =>'',
            'page' => 'bank',
            'bank' => $this->bankService->getBank($bankID)
        ];

        $this->view('admin/updateBank' , $data);
       }

        if (isset($_POST['updateBank'])) {
        $bankID = $_GET['id'];
            $data = [
                
                'bankname' => $_POST['bankname'],
                'banklogo' => $_FILES['logo'],
                'bankNameErr' =>'',
                'imgBankErr' =>'',
                'bank' => $this->bankService->getBank($bankID),
                'page' => 'bank'
            ];
            $imgStore = $_SERVER["DOCUMENT_ROOT"]."/bank-mvc/public/img/uploads/";

            // Field Is Correct Add new Bank Here 
            
            $fileName = basename($_FILES["logo"]["name"]);
            $placement = $imgStore.$fileName;
            $fileType = pathinfo($placement,PATHINFO_EXTENSION);

            $correctExt =  array("jpg","png","jpeg");


            if (in_array($fileType , $correctExt)) {
                if (move_uploaded_file($data['banklogo']['tmp_name'], $placement)) {
                    $updateBank = new Bank();
                    $updateBank->setBankID($bankID);
                    $updateBank->setBankName($data['bankname']);
                    $updateBank->setBankLogo($fileName);
                    
                    try {
                        $this->bankService->updateBank($updateBank);
                        header('Location:' . URLROOT . '/admin/bank');
                    } catch (PDOException $e) {
                        die('Failed to update bank' . $e->getMessage());
                    } 
                }else {
                    die("Failed to Uplaod images");
                }
            }else {
                $data['imgBankErr'] = "Only JPG,JPEG OR PNG";
                $this->view('admin/updateBank' , $data );
            } 
        }else{
            $bankID = $_GET['id'];
            $data =  [
    
                'bankNameErr' =>'',
                'imgBankErr' =>'',
                'page' => 'bank',
                'bank' => $this->bankService->getBank($bankID)
            ];
    
            $this->view('admin/updateBank' , $data);
            
        }
        // $data = [   
        //     'bankNameErr' => '',
        //     'imgBankErr' =>'',
        //     'page' => 'bank'
        // ];

        // $this->view('admin/updateBank' , $data);




        // header('Location:' . URLROOT . '/admin/bank');


        // $this->view('admin/deleteBank');
    }
    // ============== AGENCY ======================
    public function agency() {
        if (isset($_SESSION['rolename'])) {
            if ($_SESSION['rolename'] != 'admin') {
                header('Location:' . URLROOT . '/client/home');
            }
        }else {
            header('Location:' . URLROOT . '/pages/index');
        }
        $agency = $this->agencyService->getAllAgency();

        $data = [
            'agencies' => $agency,
            'page' => 'agency'
        ];
        $this->view('admin/agency' , $data);
        
    }

    // ============== ADD NEW AGENCY ==============
    public function addAgency() {
        ob_start();
        $data = [
            'banks' => $this->bankService->getAllBanks(),
            'page' => 'agency'

        ];
        $this->view('admin/addAgency' , $data);

        if (isset($_POST['agency'])) {
            $newAgency = new Agency();

            $data = [
                'longitude' => $_POST['longitude'],
                'latitude' => $_POST['latitude'],
                'bankID' => $_POST['bankID'],
                'ville' => $_POST['ville'],
                'quartier' => $_POST['quartier'],
                'rue' => $_POST['rue'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'code' => $_POST['code'],
                'page' => 'agency'
            ];
            $newAdress = new Adress();
            ($newAdress->setAdressID(uniqid()));
            ($newAdress->setVille($data['ville']));
            ($newAdress->setQuartier($data['quartier']));
            ($newAdress->setrue($data['rue']));
            ($newAdress->setEmail($data['email']));
            ($newAdress->setPhone($data['phone']));
            ($newAdress->setcodePostal($data['code']));

            $newBank = new Bank();
            $newBank->setBankID($data['bankID']);
            $newAgency->setAdress($newAdress); 
            $newAgency->setBank($newBank);
            $newAgency->setAgencyID(uniqid());
            $newAgency->setLongitude($data['longitude']);
            $newAgency->setlatitude($data['latitude']);

            $this->agencyService->addAgency($newAgency);
            
            header('Location:' . URLROOT . '/admin/agency');



        }

        $data = [
            'longitude' => '',
            'latitude' => '',
            'bankname' => '',
            'ville' => '',
            'quartier' => '',
            'rue' => '',
            'email' => '',
            'phone' => '',
            'code' => '',
            'page' => 'agency'
        ];
        $this->view('admin/addAgency' , $data);
        ob_end_flush();

    }
    public function user() {





        $data = [
            'page' => 'user'
        ];
        $this->view('admin/user' , $data);
    }
    // ============= Add USER ================-
    public function addUser() {
        ob_start();
        $agencies = $this->agencyService->getAllAgency();

        $data = [
            'agencies' => $agencies,
            'page' => 'user'
        ];
        $this->view('admin/addUser' , $data); 
        
        if (isset($_POST['user'])) {
            $user = new User();

            $data = [
                'username' => $_POST['username'],
                'rolename' => $_POST['rolename'],
                'agencyID' => $_POST['agencyID'],
                'password' => $_POST['password'],
                'ville' => $_POST['ville'],
                'quartier' => $_POST['quartier'],
                'rue' => $_POST['rue'],
                'email' => $_POST['email'],
                'code' => $_POST['code'],
                'phone' => $_POST['phone']
            ];

  

            try {
                $address = new Adress();
                $address->setAdressID(uniqid());
                $address->setVille($data['ville']);
                $address->setQuartier($data['quartier']);
                $address->setrue($data['rue']);
                $address->setEmail($data['email']);
                $address->setPhone($data['phone']);
                $address->setcodePostal($data['code']);
    
                $agency = new Agency();
    
                $agency->setAgencyID($data['agencyID']);
    
                
                $user->setAddress($address);
                $user->setAgency($agency);
                $user->setUserID(uniqid());
                $user->setUsername($data['username']);
                $user->setUserpass($data['password']);

                $this->userService->addUser($user , $data['rolename']);
                header('Location:' . URLROOT . '/admin/user');
                exit();

            } catch (PDOException $e) {
                print_r($e);
            }

        }
        ob_end_flush();
    }
}