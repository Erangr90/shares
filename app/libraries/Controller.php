<?php
    // The base controller
    // Loads the models & views

    class Controller {

        // Load model
        public function model($model){
            // Require model file
            require_once '../app/models/'.$model.'.php';
            // Make an Instant of the model
            return new $model();

        }

        // Load view
        public function view($view, $data=[]){
            // Check for the view file
            if(file_exists('../app/views/'.$view.'.php')){
                require_once '../app/views/'.$view.'.php';
            }else{
                die("The view '".$view."' does not exist");
            }
        }

    }
?>