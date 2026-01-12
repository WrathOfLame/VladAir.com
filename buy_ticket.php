<head>
    <link rel = 'icon' type="image/x-icon" href = 'website_icon.png'>
</head>
<?php
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once('utils.php');
include_once('db_connect.php');
if(buyTicket($conn, (int)$_GET['flight_id'])){
    echo "Ticket bought";
    reduceTicketAmount($conn, (int)$_GET['flight_id']);
}
else echo " Something went wrong";
echo "<a href='index.php'> Get back</a>";
