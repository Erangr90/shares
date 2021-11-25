<?php
// App core class - creates URL & loads core controller
// URL format - /controller/method/parameters

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params =[];

    public function __construct(){
    
        // Get the url
        $url = $this->getUrl();

        // Look in the controllers for the first value
        // The path is like from the -main- index.php
        if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
            // Set as a controller
            $this->currentController = ucwords($url[0]);
            // Unset index 0
            unset($url[0]);

        }

        // Require the controller
        require_once '../app/controllers/'.$this->currentController.'.php';
        // Make an Instant of the controller
        $this->currentController = new $this->currentController;

        // Check for the second part of the url array (the method)
        if(isset($url[1])){
            // Check if the method exist in the controller
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                // Unset index 1
                unset($url[1]);

            }

        }
        
        // Get params
        $this->params = $url ? array_values($url) : [];

        // Active the method from callback with array of params
        call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            // Clean the end of the url from '/'
            $url = rtrim($_GET['url'],'/');
            // Sanitize to valid url
            $url = filter_var($url,FILTER_SANITIZE_URL);
            // Split the url to array by '/'
            $url = explode('/',$url);
            return $url;

        }else{
            return [''];
        }
    }
}

?>