<?php

class Users extends Controller{

    public function __construct(){
        $this->userModel = $this->model('User');

    }
    // Register user
    public function register(){
        // Check if POST or GET request
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process the form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING) ;
            $data =[
                'name'=>trim($_POST['name']),
                'email'=>trim($_POST['email']),
                'password'=>$_POST['password'],
                'confirmPassword'=>$_POST['confirmPassword'],
                'name_error'=>'',
                'email_error'=>'',
                'passWord_error'=>'',
                'confirmPassword_error'=>''
            ];

            // Validate email
            if(empty($data['email'])){
                $data['email_error'] = 'Email address is require';

            }else{
                if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                    $data['email_error'] =  "Invalid email format";
                }else{
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_error'] =  "Email address already exists";
                    }
                }
            }

             // Validate name
            if(empty($data['name'])){
                $data['name_error'] = 'Name is require';

            }else{
                if(strlen($data['name']) < 2){
                    $data['name_error'] = 'Name must be at lest 2 letters';
                }
            }

            // Validate password
            if(empty($data['password'])){
                $data['password_error'] = 'Password is require';

            }else{
                if(strlen($data['password']) < 8){
                    $data['password_error'] = 'Password must be longer then 7 chartres';
                }
            }

            // Validate confirm password
            if(empty($data['confirmPassword'])){
                $data['confirmPassword_error'] = 'Confirm password is require';

            }elseif(strlen($data['confirmPassword']) < 8){
                $data['confirmPassword_error'] = 'The confirm Password must be longer then 7 chartres';
            }else{
                if($data['password'] != $data['confirmPassword']){
                    $data['confirmPassword_error'] = 'Passwords do not match';
                }
            }

            // Make sure there are no errors
            if(empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirmPassword_error'])){
                // Hash the password
                $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                // Register user
                if($this->userModel->register($data)){
                    flash('Sing up','Your sing up success!<br> you can login');
                    redirect('users/login');

                }else{
                    die('Something went wrong');

                }
                
            }else{
                // Load the view with errors
                $this->view('users/register', $data);
            }

        }else{
            // Init data
            $data =[
                'name'=>'',
                'email'=>'',
                'password'=>'',
                'confirmPassword'=>'',
                'name_error'=>'',
                'email_error'=>'',
                'passWord_error'=>'',
                'confirmPassword_error'=>''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }


    // Login user
    public function login(){
        // Check if POST or GET request
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process the form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING) ;
            $data =[
                'email'=>trim($_POST['email']),
                'password'=>$_POST['password'],
                'email_error'=>'',
                'passWord_error'=>'',
            ];

            // Validate email
            if(empty($data['email'])){
                $data['email_error'] = 'Email address is require';

            }else{
                if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                    $data['email_error'] =  "Invalid email format";
                }else{
                    if(!($this->userModel->findUserByEmail($data['email']))){
                        $data['email_error'] =  "No user found";
                    }
                }
            }

            // Validate password
            if(empty($data['password'])){
                $data['password_error'] = 'Password is require';

            }else{
                if(strlen($data['password']) < 8){
                    $data['password_error'] = 'Password must be longer then 7 chartres';
                }
            }

            // Make sure there are no errors
            if(empty($data['email_error']) && empty($data['password_error'])){
                // Check & set login user
                $loggedInUser = $this->userModel->login($data['email'],$data['password']);
                if($loggedInUser){
                    // Create session
                    $this->createUserSession($loggedInUser);

                }else{
                    // Password not match
                    $data['password_error'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
                
            }else{
                // Load the view with errors
                $this->view('users/login', $data);
            }

        }else{
            // Init data
            $data =[
                'email'=>'',
                'password'=>'',
                'email_error'=>'',
                'passWord_error'=>'',
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }


    // Logout user
     public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }


    // Create session for the user
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('posts');

    }
}

?>