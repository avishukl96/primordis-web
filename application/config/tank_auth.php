<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// General configuration
$config['use_ci_sessions'] = TRUE;  // Whether to use CI's session library
$config['login_url'] = 'auth/login'; // Login page URL
$config['login_redirect'] = 'dashboard'; // Redirect to dashboard after login
$config['logout_redirect'] = 'auth/login'; // Redirect to login after logout
$config['session_expiration'] = 3600;  // Session expiration time (in seconds)

// Email settings
$config['use_email_activation'] = FALSE;  // Whether to require email activation for registration

// Security settings
$config['min_password_length'] = 6;  // Minimum password length
$config['max_login_attempts'] = 5;  // Max login attempts before account is locked

?>
