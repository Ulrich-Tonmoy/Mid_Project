<?php

if (isset($_POST['submit'])) {
    $name               = $_POST['name'];
    $uname              = $_POST['uname'];
    $password           = $_POST['password'];
    $cpassword          = $_POST['cpassword'];
    $email              = $_POST['email'];
    $userType           = $_POST['userType'];

    if (empty($name) || empty($uname) || empty($password) || empty($cpassword) || empty($email) || empty($userType)) {
        echo "null submission found!";
    }
    if (!preg_match("/^[A-Za-z]{4,}*$/", $name)) {
        echo "<span style='color:red;'>*Please enter a valid name</span>";
    }
    if (!preg_match("/^[A-Za-z0-9]*$/", $uname)) {
        echo "<span style='color:red;'>*Please enter a valid user name</span>";
    }
    if (!preg_match("/^[A-Za-z0-9]{4,10}$/", $password)) {
        echo "<span style='color:red;'>*Password is not big enough</span>";
    }
    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{3,8}$/ix", $email)) {
        echo "<span style='color:red;'>*Email is invalid</span>";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'project');
        $sql = "SELECT email FROM user WHERE email = '$email'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row > 0) {
            echo "<span style='color:red;'>Email already exists</span>";
        }
        $sql = "SELECT uname FROM user WHERE uname = '$uname'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row > 0) {
            echo "<span style='color:red;'>User name already exists</span>";
        } else {
            if ($password == $cpassword) {
                $con = mysqli_connect('localhost', 'root', '', 'project');
                $sql = "INSERT INTO user (name,uname,password,email,userType)
                VALUES('$name','$uname','$password','$email','$userType')";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    header('location: login.html');
                }
            } else {
                echo "password and confirm password doesnt match";
            }
        }
    }
} else {
    echo "error!";
}
