<?php

add_action("rest_api_init", "enterRoutes");

function enterRoutes(){
  register_rest_route("enter/v1", "authenticate", array(
    "methods" => "POST",
    "callback" => "LauthenticateUser",
    "args" => array(
      "user_login" => array(
        "type" => "string",
        "required" => true
      ),
      "user_pass" => array(
        "type" => "string",
        "required" => true
      )
    )
  ));
}

function LauthenticateUser($body){
 
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
 

  //$user = get_user_by('users', $data['user_login'] );
  
  global $wpdb; // Get global WordPress database object

  $table_name = $wpdb->prefix . 'users'; // Replace with your actual table name
  $column_name = 'user_login'; // Replace with the column name you want to search by
  $search_value = $data['user_login']; // Replace with the value you want to find in the column
  
  $sql = "SELECT * FROM $table_name WHERE $column_name = '$search_value' LIMIT 1"; // Limit to 1 row
  $results = $wpdb->get_results($sql);
 
  $url = home_url();
  //$bo = $results[0]->user_pass == $data['user_pass'];

  if( $results[0]->user_pass == $data['user_pass'] ){
    return  $response = array(
      "status" => true,
      //"message" => "Authentication success",
      "location" => $url
    );
  }
  else{
    return  $response = array(
      "status" => false,
      "message" => "Wrong Username or Password! Please try again",
    );
  }
  
}

?>