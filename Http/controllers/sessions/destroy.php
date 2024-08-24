<?php

// Log out the user
use Core\Authenticator;

(new Authenticator)->logout();

// Redirect user to home page
header('location: /');
exit();