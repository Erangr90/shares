<?php

class Pages extends Controller {
    public function __construct(){
        
       
    }

    public function index(){
        
        if(isLogin()){
            redirect('posts');
        }

        $data = ['title'=>'Shares',
                 'description'=>'Share every thing with us'
                ];
        $this->view('pages/index',$data);
       

    }

    public function about(){
        $data = ['title'=>'About us',
                 'description'=>'App to share what ever you want'
                ];
        $this->view('pages/about',$data);
        

    }
}


?>