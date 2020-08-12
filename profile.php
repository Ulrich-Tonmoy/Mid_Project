<?php
session_start();
if (isset($_POST['submit1'])) {

    $filedir = 'upload/' . "user" . '.png';

    if (move_uploaded_file($_FILES['file']['tmp_name'], $filedir)) {
        echo "Done";
    } else {
        echo "error";
    }
}

if (isset($_POST['submit'])) {
    $name               = $_POST['name'];
    $uname              = $_POST['uname'];
    $email              = $_POST['email'];

    if (empty($name) || empty($uname) || empty($email)) {
        echo "null submission found!";
    }
    if (!preg_match("/^[A-Za-z]*$/", $name)) {
        echo "<span style='color:red;'>*Please enter a valid name</span>";
    }
    if (!preg_match("/^[A-Za-z0-9]*$/", $uname)) {
        echo "<span style='color:red;'>*Please enter a valid user name</span>";
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
            $con = mysqli_connect('localhost', 'root', '', 'project');

            $sql = "UPDATE user SET name='$name',uname='$uname',email='$email' where name='$name'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo "done";
            }
        }
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
</head>

<body>
    <table border="1" style="width: 100%; border: 1px solid;">
        <tr>
            <td align="right" colspan="3">
                <h1>Loggedin as Admin</h1>
            </td>
        </tr>

        <tr>
            <td width="200px">
                <ul>
                    <li><a href="home.html">Home</a></li>
                    <li><a href="fundraiser.php">Fundraiser</a></li>
                    <li><a href="donor.php">Donor</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </td>
            <td>
                <fieldset>
                    <legend><b>PROFILE</b></legend>
                    <img src="<?php if (isset($_POST['submit1'])) {
                                    echo "upload/user.png";
                                } else {
                                    echo "user.png";
                                } ?>" width="60px">
                    <form method="POST" enctype="multipart/form-data">
                        <br>
                        <input type="file" name="file">
                        <input type="submit" name="submit1" value="Upload">
                        <br>
                        <br />
                        <table width="500px" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td>
                                    <input name="name" type="text" value="<?php echo $_SESSION['name']; ?>" />
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr />
                                </td>
                            </tr>
                            <tr>
                                <td>User Name</td>
                                <td>:</td>
                                <td>
                                    <input name="uname" type="text" value="<?php echo $_SESSION['uname']; ?>" />
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr />
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>
                                    <input name="email" type="text" value="<?php echo $_SESSION['email']; ?>" />
                                    <abbr title="hint: sample@example.com"><b>i</b></abbr>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <hr />
                                </td>
                            </tr>
                            <tr>
                                <td>User type</td>
                                <td>:</td>
                                <td>
                                    <?php echo $_SESSION['userType']; ?>
                                </td>
                            </tr>
                        </table>
                        <hr />
                        <input name="submit" type="submit" value="Submit" />
                        <a href="change_password.php">Change Password</a>
                    </form>

                </fieldset>
            </td>
        </tr>
    </table>
</body>

</html>