<?php

add_action("rest_api_init", "registerRoutes");
/*
 register_rest_route('whatsapp/v1', '/members', array(
        'methods' => 'POST',
        "callback" => "addMember",
        'args' => array(
            'name' => array(
                'type' => 'string',
                'required' => true
            ),
            'phone' => array(
                'type' => 'string',
                'required' => true
            )

        )
    )); */
function registerRoutes() {
    register_rest_route("register/v1", "authenticate", array(
      "methods" => "POST",
      "callback" => "RauthenticateUser",
      "args" => array(
        "user_login" => array(  
          "type" => "string",
          "required" => true
        ),
        "user_pass" => array(
          "type" => "string",
          "required" => true
        ),
        "user_email" => array(  
          "type" => "string",
          "required" => true
        ),
        "dateOfBirth" => array(
          "type" => "string",
          "required" => true
        )
      )
    ));
  }

  function RauthenticateUser($body)
{
    global $wpdb;
    $data = array();
    $table_name = $wpdb->prefix . "users";

    if (isset($body['user_login'])) {
        $data['user_login'] = $body['user_login'];
    }
    if (isset($body['user_pass'])) {
      $data['user_pass'] = $body['user_pass']; 
      // $data['user_pass'] = wp_hash_password($body['user_pass']);
    }
    if (isset($body['user_email'])) {
        $data['user_email'] = $body['user_email'];
    }
    if (isset($body['dateOfBirth'])) {
        $data['dateOfBirth'] = $body['dateOfBirth'];
    }
    
    
    $wpdb->insert($table_name, $data);
    return array(
        'message' => 'registered succcessefully'

    );
}

/*
function RauthenticateUser($request) {
  $action = $request->get_param('action');
  $user_login = $request->get_param('user_login'); 
  $password = $request->get_param('password');
  $user_email = $request->get_param('user_email');  
  $dateOfBirth = $request->get_param('dateOfBirth');


  $data = array(
    'user_login' => $user_login,  
    'user_pass' => wp_hash_password($password),
    'user_email' => $user_email,  
    'dateOfBirth' => $dateOfBirth,
    'user_registered' => date('Y-m-d H:i:s'),  
  );

  global $wpdb;
  $table_name = $wpdb->prefix . 'users'; 

  if ($action === 'register') {
    $result = $wpdb->insert($table_name, $data);

    if ($result === false) {
        // Handle insertion error
        $error_message = $wpdb->last_error;
        // Log the error or provide a more specific error message to the user
        //return false;
      } else {
        wp_set_current_user($user->ID); 
        wp_safe_redirect('https://google.com'); 
       // return true;
      } 

    

  } else if ($action === 'login') {
    // Login logic
    $user = wp_authenticate_username_password(null, $username, $password);

    if (is_wp_error($user)) {
      $error_message = $user->get_error_message();
      return array(
        "success" => false,
        "message" => "Invalid username or password. Please try again."
      );
    } else {
      // Login successful, redirect to Google
      wp_set_current_user($user->ID); // Set the current user
      wp_safe_redirect('https://google.com'); // Redirect to Google
      exit; // Exit after redirection
    }
  } else {
    // Handle invalid action (optional)
    return array(
      "success" => false,
      "message" => "Invalid action provided."
    );
  }
}
*/