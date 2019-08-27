<?php
 $db = [
    'db_host'   => 'localhost',
    'db_user'   => 'phpmyadminuser',
    'db_pass'   => 'admin',
    'db_name'   => 'test_db',
    'db_driver' => 'mysql'
];

foreach ($db as $key => $value)
{
    define(strtoupper($key), $value);
}