<?php
session_start();
if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    if (empty($email)) {
        echo "null submission found!";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'project');
        $sql = "select * from user where email='$email'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row > 0) {
            echo $row['password'];
        } else {
            echo "Invalid email!";
        }
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>

<body>
    <table width="500px" height="600px" border="1" align="center">
        <tr height="100px">
            <td align="right">
                <a href="login.html"> Login</a> |
                <a href="registration.html"> Registration</a>
            </td>
        </tr>
        <tr>
            <td>
                <form action="" method="POST">
                    <fieldset>
                        <legend><b>FORGOT PASSWORD</b></legend>
                        <form>
                            Enter Email:
                            <input name="email" type="text" />
                            <hr />
                            <input name="submit" type="submit" value="Submit" />
                        </form>
                    </fieldset>
                </form>
            </td>
    </table>
</body>

</html>