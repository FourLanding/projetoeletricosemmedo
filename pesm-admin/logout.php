<?php

session_start();

session_destroy();
$_SESSION['logged'] = null;
$_SESSION['uAdmin'] = null;
unset($_SESSION['uAdmin']);
unset($_SESSION['logged']);

header("Location: login.php?logout=true");