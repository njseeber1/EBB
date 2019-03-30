<?php
session_start(void);
unset($_SESSION['user']);
session_destroy();
header ('Location: login.php');
?>