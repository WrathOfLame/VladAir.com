<?php
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once("db_connect.php"); require_once('utils.php');
$error_message = '';
if(isset($_POST['createAccount'])){
    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repassword']) && isset($_POST['name']) && isset($_POST['surname'])){
        if($_POST['password'] === $_POST['repassword']){
            if(createAccount($conn, $_POST['email'], $_POST['password'], $_POST['name'], $_POST['surname'])){
                header("Location: index.php");
                exit();
            }else $error_message .= 'There is already a user with your email<br>';
        }else $error_message .= 'Your passwords do not match<br>';
    }else $error_message .= 'You need to fill all the fealds<br>';
}
?>
<head>
    <title>Create account</title>
    <link rel = 'icon' type="image/x-icon" href = 'website_icon.png'>
</head>
<header>
    <a href="index.php"><img src="website_icon.png" alt="website photo" width = "50"></a>
</header>
<form method="post">
    <div>
        <label>Enter email</label>
        <input type="text" name="email">
        <label>Enter password</label>
        <input type="password" name='password'>
        <label>Repeat password</label>
        <input type="password" name='repassword'>
        <label>Enter name</label>
        <input type="text" name='name'>
        <label>Enter surname</label>
        <input type="text" name='surname'>
    </div>
    <button type = 'submit' name = 'createAccount'>Create</button>
    <?php if(!empty($error_message)) echo $error_message; ?>
</form>
<style>
    a:not([src = 'website_icon.png']){
    margin-top: 10px;
    text-decoration: none;
    }
    header{
        width: 99%;
    }
    #login{
        position: absolute;
        right: 5%;
    }
    a:not([src = 'website_icon.png']):hover{
        text-decoration: underline;
        color: rgb(193, 216, 91);
    }
    form div{
        display: grid;
        grid-template-columns: 2fr 3fr;
        grid-gap: 5px;
        margin: 10px;
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
