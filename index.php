<?php
session_start();

if(isset($_COOKIE['username']) && isset($_COOKIE['password']))
{
    $textcontent = file("debe.txt", FILE_IGNORE_NEW_LINES);

    for($i=0; $i<count($textcontent); $i+=4)
    {
        if($_COOKIE['username'] == $textcontent[$i] &&
           $_COOKIE['password'] == $textcontent[$i+1])
        {
            $_SESSION['username'] = $textcontent[$i];
            $_SESSION['role'] = $textcontent[$i+2];
            header("Location: main.php");
            exit();
        }
    }
}

if(isset($_POST['login']))
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $textcontent = file("debe.txt", FILE_IGNORE_NEW_LINES);

    $found = false;

    for($i=0; $i<count($textcontent); $i+=4)
    {
        if($username == $textcontent[$i] &&
           $password == $textcontent[$i+1])
        {
            $found = true;

            $_SESSION['username'] = $username;
            $_SESSION['role'] = $textcontent[$i+2];

            if(isset($_POST['remember']))
            {
                setcookie("username",$username,time()+10);
                setcookie("password",$password,time()+10);
            }

            header("Location: main.php");
            exit();
        }
    }

    if(!$found)
    {
        $_SESSION['error'] = "Invalid Username or Password!";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

$error = "";
if(isset($_SESSION['error']))
{
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Photo Contest Portal Login</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:linear-gradient(to right,#1e232b,#232b35);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.login-box{
    width:450px;
    background:rgba(128,136,146,0.9);
    padding:40px;
    border-radius:10px;
    box-shadow:0 0 15px rgba(0,0,0,0.5);
}

h1{
    color:white;
    text-align:center;
    margin-bottom:30px;
}

label{
    color:white;
    display:block;
    margin-top:15px;
    margin-bottom:8px;
}

input[type=text],
input[type=password]{
    width:100%;
    padding:12px;
    border:none;
    border-radius:5px;
}

.remember{
    color:white;
    margin-top:15px;
}

.btn{
    width:100%;
    padding:12px;
    margin-top:20px;
    background:#1e73ff;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

.btn:hover{
    background:#005ce6;
}

.error{
    background:#ff4d4d;
    color:white;
    text-align:center;
    padding:10px;
    margin-top:15px;
    border-radius:5px;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="login-box">

    <h1>Photo Contest Portal Login</h1>

    <form method="post">

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <div class="remember">
            <input type="checkbox" name="remember">
            Remember Me
        </div>

        <input type="submit" name="login" value="Login" class="btn">

        <?php
        if($error != "")
        {
            echo "<div class='error'>$error</div>";
        }
        ?>

    </form>

</div>

</body>
</html>