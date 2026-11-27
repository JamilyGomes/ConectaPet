
<?php
session_start();

$_SESSION = [];
session_destroy();

header('Location: /ConectaPet/app/Views/pages/user/login.php');
exit;
