<?php

session_start();

function checkLogin(mysqli $conn, string $accountName, string $accountPassword):bool{
    $query = "SELECT * From users where accountName = '$accountName' and accountPassword = '$accountPassword'";
    $respond = $conn -> query($query);
    if(mysqli_num_rows($respond) > 0){
        $_SESSION['isLogged'] = true;
        $row = mysqli_fetch_assoc($respond);
        $_SESSION['userRole'] = $row['role'];
        $_SESSION['userId'] = $row['id'];
        return true;
    }
    return false;
}

function logOut():void{
    session_destroy();
    header("Location: index.php");
}
function createAccount(mysqli $conn, string $email, string $password, string $name, string $surname):bool{
    $query = "INSERT INTO users (accountName, accountPassword, name, surname) VALUES ('$email', '$password', '$name', '$surname')";
    $respond = $conn -> query($query);
    if($respond) return true;
    return false;
}
function buyTicket(mysqli $conn, int $flight_id):bool{
    $userId = $_SESSION['userId'];
    $query = "UPDATE `users` set tickets_bought = CONCAT(tickets_bought, '#$flight_id ') where id='$userId'";
    $respond = $conn -> query($query);
    if($respond) return true;
    else return false;
}
function reduceTicketAmount(mysqli $conn, int $flight_id):void{
$query = "UPDATE `flights` SET `ticket_amount`= `ticket_amount`-1 WHERE flight_id = '$flight_id'";
$conn -> query($query);
}
function searchConnections(mysqli $conn, $departure, $destination):void{
    if(isset($_POST['departure']) && isset($_POST['destination'])){
        $query = "SELECT * FROM `flights` WHERE departure = '$departure' AND destination = '$destination'";
        $respond = $conn -> query($query);
        if(mysqli_num_rows($respond) > 0){
            echo "<table border = '2'>";
            echo "<tr>";
            echo "<th>Flight id</th>";
            echo "<th>Flight departure</th>";
            echo "<th>Flight destination</th>";
            echo "<th>Flight date</th>";
            echo "<th>Tickets left</th>";
            echo "<th>Sell</th>";
            echo "</tr>";
            while($row = mysqli_fetch_assoc($respond)){
                echo "<tr>";
                echo "<td>" . $row['flight_id'] . "</td>";
                echo "<td>" . $row['departure'] . "</td>";
                echo "<td>" . $row['destination'] . "</td>";
                echo "<td>" . $row['flight_date'] . "</td>";
                echo "<td>" . $row['ticket_amount'] . "</td>";
                if($row['ticket_amount']>0 && $_SESSION['isLogged']) echo "<td>" . '<a href="buy_ticket.php?flight_id='.urlencode($row['flight_id']).'">Buy</a>' . "</td>";
                else echo "<td><p>All tickets are sold or you need to login</p></td>";
                echo "</tr>";
            }
            echo "</table>";
        }else{
            echo "No connection found";
        }
    }
}
