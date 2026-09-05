<?php
declare(strict_types=1);

use AfroVerified\Auth;

require dirname(__DIR__) . '/vendor/autoload.php';

$destination = Auth::user() ? 'dashboard.html' : 'login.html';
header('Location: ' . $destination, true, 302);
exit;
