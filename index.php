<?php
if (!session_id()) session_start();

// error_reporting(0);
error_reporting(~E_NOTICE);
require_once 'app/init.php';

$app = new App($db);
