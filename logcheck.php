<?php

session_start();

if (isset($_POST['submit'])) {

    $uname         = $_POST['uname'];
    $password     = $_POST['password'];

    if (empty($uname) || empty($password)) {
        echo "null submission found!";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'project');
        $sql = "select * from user where uname='$uname' and password='$password'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row > 0) {
            $name     = $row['name'];
            $uname    = $row['uname'];
            $email    = $row['email'];
            $userType = $row['userType'];

            $_SESSION['name'] = $name;
            $_SESSION['uname'] = $uname;
            $_SESSION['email'] = $email;
            $_SESSION['userType'] = $userType;
            header('location: home.html');
        } else {
            header('location: login.php?msg=invalid_id/password');
        }
    }
} else {
    header('location: login.html');
}
