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
    font-family:"Segoe UI",sans-serif;
}

:root{
    --bg-dark:#0b1320;
    --bg-secondary:#16263d;
    --primary:#38bdf8;
    --primary-hover:#0ea5e9;
    --text-light:#f8fafc;
    --danger:#ef4444;
}


body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;

    background:
        linear-gradient(
            135deg,
            #081120 0%,
            #10203a 35%,
            #16263d 70%,
            #0b1320 100%
        );

    overflow:hidden;
    position:relative;
}

/* Decorative glow */
body::before{
    content:"";
    position:absolute;
    width:500px;
    height:500px;

    background:rgba(56,189,248,0.12);
    border-radius:50%;

    top:-150px;
    left:-150px;

    filter:blur(100px);
}

/* Decorative glow */
body::after{
    content:"";
    position:absolute;
    width:450px;
    height:450px;

    background:rgba(37,99,235,0.12);
    border-radius:50%;

    bottom:-150px;
    right:-150px;

    filter:blur(100px);
}

/* Login Card */
.login-box{
    width:450px;
    padding:40px;

    background:rgba(22,38,61,0.92);

    border:1px solid rgba(56,189,248,0.2);
    border-radius:18px;

    box-shadow:
        0 12px 30px rgba(0,0,0,0.5);

    backdrop-filter:blur(8px);
}

h1{
    color:#7dd3fc;
    text-align:center;
    margin-bottom:30px;
    font-size:28px;
}

/* Labels */
label{
    display:block;
    color:var(--text-light);
    margin-top:15px;
    margin-bottom:8px;
    font-weight:600;
}

/* Inputs */
input[type=text],
input[type=password]{
    width:100%;
    padding:12px;

    background:rgba(255,255,255,0.06);

    border:1px solid rgba(255,255,255,0.12);
    border-radius:10px;

    color:white;
    outline:none;
}

input[type=text]:focus,
input[type=password]:focus{
    border-color:var(--primary);
    box-shadow:0 0 12px rgba(56,189,248,0.3);
}

/* Remember */
.remember{
    color:white;
    margin-top:15px;
}

/* Button */
.btn{
    width:100%;
    padding:13px;
    margin-top:20px;

    border:none;
    border-radius:10px;

    background:linear-gradient(
        135deg,
        #38bdf8,
        #2563eb
    );

    color:white;
    font-size:15px;
    font-weight:600;
    cursor:pointer;

    transition:0.3s;
}

.btn:hover{
    transform:translateY(-2px);

    background:linear-gradient(
        135deg,
        #0ea5e9,
        #1d4ed8
    );
}

/* Error Message */
.error{
    margin-top:15px;
    padding:12px;

    background:rgba(239,68,68,0.2);
    border:1px solid rgba(239,68,68,0.5);

    color:#fecaca;
    text-align:center;
    border-radius:10px;
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