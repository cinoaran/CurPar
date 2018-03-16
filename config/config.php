<?php
//Debuging IS SET TO TRUE MEANS error_reporting(E_ALL) will executed false = NOT
define('DEBUG' , true);

define('DB_HOST', 'localhost');
define('DB_NAME', 'ruah');
define('DB_USER', 'root');
define('DB_PASSWORD', '1234');

//DEFINE DEFAULT_CONTROLLER if no Controller is defined in the url / use Home
define('DEFAULT_CONTROLLER' , 'Home');
//DEFINE DEFAULT_LAYOUT if no layout is set in the controller use this layout
define('DEFAULT_LAYOUT' , 'default');
//PROJECT ROOT here as PROOT /ruah/ SET THIS to '/' for a live server
define('PROOT', '/ruah/');
//This is default Site Titel
define('SITE_TITLE', 'Ruah MVC Framework');
//Session name for loggedin user
define('CURRENT_USER_SESSION_NAME', 'sHtjd8dehWRimnewoidCQJf');
//Cookie name for loggedin user
define('REMEMBER_ME_COOKIE_NAME', 'swUJJENJHkkNSJUNkujnTNe');
//time in second for remeber me cookie to live 30 days
define('REMEMBER_ME_COOKIE_EXPIRY', 2592000);
