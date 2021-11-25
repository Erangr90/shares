<?php

session_start();

  // Flash message helper
  // EXAMPLE - flash('register_success', 'You are now registered');
  // DISPLAY IN VIEW - echo flash('register_success');
  function flash($title = '', $message = '', $class = 'alert alert-success'){
    if(!empty($title)){
      if(!empty($message) && empty($_SESSION[$title])){
        if(!empty($_SESSION[$title])){
          unset($_SESSION[$title]);
        }

        if(!empty($_SESSION[$title. '_class'])){
          unset($_SESSION[$title. '_class']);
        }

        $_SESSION[$title] = $message;
        $_SESSION[$title. '_class'] = $class;
      } elseif(empty($message) && !empty($_SESSION[$title])){
        $class = !empty($_SESSION[$title. '_class']) ? $_SESSION[$title. '_class'] : '';
        echo '<div class=" text-center '.$class.'" id="msg-flash">'.$_SESSION[$title].'</div>';
        unset($_SESSION[$title]);
        unset($_SESSION[$title. '_class']);
      }
    }
  }

  // Check if user login
  function isLogin(){
    if(isset($_SESSION['user_id'])){
        return true;
    }
    return false;
  }


?>