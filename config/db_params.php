<?php

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
);

return array(
    'host' => 'localhost',
    'dbname' => 'terminal',
    'user' => 'admin',
    'password' => '12345678',
    'options' => $options
);