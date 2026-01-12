<?php
$SERVER_NAME = 'localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_NAME = 'vlad_air';

$conn = mysqli_connect($SERVER_NAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

if(!$conn){
    die("Connection wasn't successful: ".mysqli_connect_error());
}
