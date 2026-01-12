<?php
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once("db_connect.php");
require('utils.php');
$errorMessage = '';
if(isset($_POST['email']) && isset($_POST['password'])){
    if(checkLogin($conn, $_POST['email'], $_POST['password'])){
        header("Location: index.php");
        exit();
    }else{
        $errorMessage = "Either email or password that you've inserted is wrong";
    }
}?>
<head>
    <title>Log in</title>
    <link rel = 'icon' type="image/x-icon" href = 'website_icon.png'>
</head>
<header>
    <a href="index.php" id = 'webImg'><img src="website_icon.png" alt="website photo" width = "50"></a>
</header>
<form method="post">
    <div>
        <label>Enter email</label>
        <input type="text" name="email">
    </div>
    <div>
        <label>Enter password</label>
        <input type="password" name='password'>
        <a href="createAccount.php">Create account</a>
    </div>
    <button type = 'submit'>Log in</button>
    <?php if (!empty($errorMessage)) echo "<p>$errorMessage</p>";?>
</form>

<style>
    #webImg{
        position: relative;
        left: 10px;
        width:5%;
    }
    a:not([src = 'website_icon.png']){
        margin-top: 10px;
        text-decoration: none;
    }
    header{
        width: 99%;
    }
    a:not([src = 'website_icon.png']):hover{
        text-decoration: underline;
        color: rgb(193, 216, 91);
    }
    form div{
        display: block;
        margin: 10px;
    }
    a{
        display: block;
        position: relative;
        left: 60%;
        top: 5%;
    }
    form{
        position: absolute;
        left: 40%;
        padding: 20px;
        background-color: rgb(226, 240, 162);
        border-radius: 10px
    }
    button{
        position: relative;
        left: 40%
    }
    input{
        margin-left: 10px;
        background-color: #fff;
        border-radius: 5px;
    }
    input[type='text']{
        margin-left: 35px;
    }
    input:focus{
        animation: inputBgColorChanging 0.3s ease forwards;
        outline: none;
    }
    input:not(:focus){
        animation: inputClearColor 0.3s ease forwards;
    }
    @keyframes inputBgColorChanging {
        from{background-color: #fff;}
        to{background-color: rgb(255, 255, 189);}
    }
    @keyframes inputClearColor {
        from{background-color: rgb(255, 255, 189);}
        to{background-color: #fff;}
    }
</style>
