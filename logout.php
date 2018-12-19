<?php
session_start();

unset($_SESSION['verified_user']);
unset($_SESSION['acctID']);
unset($_SESSION['acctFN']);
unset($_SESSION['acctLN']);
unset($_SESSION['acctEM']);
unset($_SESSION['acctPR']);
unset($_SESSION['acctBG']);
session_destroy();
header('Location:index.php');
