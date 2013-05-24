<?php

include_once('_inc/global.php');

$Users->logout();

header('Location: index');
exit;