<?php

class User{
    private $db;

    public function __construct(){
        $this->db = new Database();
        
    }
    // Register user
    public function register($data){
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name,:email, :password)');
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);
        if($this->db->execute()){
            return true;
        }
        return false;

    }

    // Login user
    public function login($email, $password){

        // Get the user by email
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email',$email);
        $user = $this->db->singleResult();
        // Check if the password match
        if(password_verify($password,$user->password)){
            return $user;
        }
        return false;
    }

    // Get user by id
    public function getUserById($id){
        $this->db->query('SELECT * FROM users WHERE id=:id');
        $this->db->bind(':id',$id);

        $user = $this->db->singleResult();

        if(empty($user)){
            return false;
        }
        return $user;

    }

    // Check if user exists by email
    public function findUserByEmail($email){

        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email',$email);

        $user = $this->db->singleResult();

        if(empty($user)){
            return false;
        }
        return true;

        // if($this->db->recordsCount() > 0){
        //     return true;
        // }

        // return false;

    }


    
}



?>