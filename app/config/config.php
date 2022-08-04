<?php

// Timezone Set
date_default_timezone_set('Asia/Jakarta');

//BASE URL
$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['base_url'] .= "://" . $_SERVER['HTTP_HOST'];
$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
define('BASEURL', $config['base_url']);

//DB CONFIG
define('DB_HOST', 'localhost');
define('DB_USER', 'ziieekun');
define('DB_PASS', 'cyber256');
define('DB_NAME', 'profile');
