<?php session_start();
foreach ($_SESSION as $sessionData) {
    unset($sessionData);
};

session_destroy();
echo 'vous vous êtes déconnecté du site web';

exit;
