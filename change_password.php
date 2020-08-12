<?php
session_start();
if (isset($_POST['submit'])) {
    $old = $_POST['oldpass'];
    $new = $_POST['newpass'];
    $con = $_POST['conpass'];
    $name = $_SESSION['name'];

    if (empty($old) || empty($new) || empty($con)) {
        echo "null submission found!";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'project');
        $sql = "select * from user where name='$name' and password='$old'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row > 0) {
            $sql = "UPDATE user SET password='$new' where name='$name'";
            $result = mysqli_query($con, $sql);

            if ($result) {
                echo "password changed";
            } else {
                echo "error!";
            }
        } else {
            header('location: change_password.php');
        }
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Change Password</title>
</head>

<body>
    <table border="1" style="width: 100%; border: 1px solid;">
        <tr>
            <td align="right" colspan="2">
                <h1>Loggedin as Admin</h1>
            </td>
        </tr>

        <tr>
            <td>
                <ul>
                    <li><a href="home.html">Home</a></li>
                    <li><a href="fundraiser.php">Fundraiser</a></li>
                    <li><a href="donor.php">Donor</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </td>
            <td>
                <form action="" method="POST">
                    <table>
                        <tr>
                            <td>Old Password</td>
                            <td>:</td>
                            <td><input name="oldpass" type="password" /></td>
                        </tr>
                        <tr>
                            <td>New Password</td>
                            <td>:</td>
                            <td><input name="newpass" type="password" /></td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                            <td>:</td>
                            <td><input name="conpass" type="password" /></td>
                        </tr>
                    </table>
                    <hr />
                    <input name="submit" type="submit" value="Submit" />
                </form>
            </td>
        </tr>
    </table>
</body>

</html>