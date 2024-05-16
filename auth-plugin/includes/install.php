<?php
function logSign_plugin_activation() {
  global $wpdb;

  // Use the existing WordPress user table (wp_users)
  $table_name = $wpdb->prefix . 'users';

  $charset_collate = $wpdb->get_charset_collate();

  // Add a new column for dateOfBirth if it doesn't exist
  $dateOfBirth_column = "dateOfBirth DATE NOT NULL";

  $sql = "ALTER TABLE $table_name ADD $dateOfBirth_column;";
  $wpdb->query($sql); // Attempt to add the dateOfBirth column

  // No need to define separate register_user and authenticate_user functions
  // We can use the built-in WordPress user registration and authentication functions
}
/*function logSign_plugin_activation() {
    global $wpdb;
    $prefix = $wpdb->prefix;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  
    // Define a more descriptive table name
    $table_name = $prefix . 'logsign_users';
  
    $charset_collate = $wpdb->get_charset_collate();
  
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        firstname VARCHAR(255) NOT NULL,
        lastname VARCHAR(255) NOT NULL,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        dateOfBirth DATE NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
  
    dbDelta($sql);
  }*/
  
  // Function to register a new user with password hashing
  /*
  function register_user($user_login, $user_pass, $user_email, $dateOfBirth) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'logsign_users';
  
    // Hash the password before storing
    $hashed_password = wp_hash_password($password);
  
    $data = array(
      'user_login' => $user_login,  // Matches user_login column
      'user_pass' => wp_hash_password($password),
      'user_email' => $user_email,  // Matches user_email column
      'dateOfBirth' => $dateOfBirth,
      'user_registered' => date('Y-m-d H:i:s'),  // Current date and time
    );
    $result = $wpdb->insert($table_name, $data);
  
    if ($result === false) {
      // Handle insertion error
      $error_message = $wpdb->last_error;
      // Log the error or provide a more specific error message to the user
      return false;
    } else {
      // User registered successfully
      return true;
    }
  }
  
  // Function to authenticate a user with password verification
  function authenticate_user($user_login, $user_pass) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'logsign_users';
  
    $user = $wpdb->get_row(
      $wpdb->prepare("SELECT * FROM $table_name WHERE user_login = %s", $user_login)
    );
  
    if (!$user) {
      // User not found
      return false;
    } else {
      // Verify the password
      if (password_verify($user_pass, $user->user_pass)) {
        // Authentication successful
        return true;
      } else {
        // Incorrect password
        return false;
      }
    }
  }*/
