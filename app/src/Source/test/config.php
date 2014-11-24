<?php
// -------------------------------------------------------------------------------------------
//
// config.php
//

//
// Setting for the database connection
//
define('DB_HOST', 		'localhost');	// The database host
define('DB_USER', 		'Mikael');	// The username of the database
define('DB_PASSWORD', 	'hemligt');	// The users password
define('DB_DATABASE', 	'Skolan1');	// The name of the database to use

$username = "hemligt";
$user = "hemligt";
$USER = "hemligt";

$password = "hemligt";
$pwd = "hemligt";
$PASSWD = "hemligt";

return [
    'dsn'       => "mysql:host=blu-ray.student.bth.se;dbname=jokd13;",
    'username'  => "user",
    'User'      => "user",
    'password'  => "secret",
    'Pwd'       => "secret",
];


//
// These should NOT be matched
//
$new = $password;
$new = 'password';

$user = $hemligt;

return [
    'user' => $hemligt,
]
