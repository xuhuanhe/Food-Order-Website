<?php include('../config/constants.php');?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css"></link>
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            <!-- login form starts here -->
            <form action="" method="POST" class="text-center">
                Username:<br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password:<br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!-- login form ends here -->
            <p class="text-center">Created By - <a href="www.xuhuan.com">Xuhuan He</a></p>
        </div>
    </body>
</html>

<?php
    //check whether the submit button is check or not
    if(isset($_POST['submit'])){
        //process
        //1.get the data from login form
        // $username=$_POST['username'];
        $username=mysqli_real_escape_string($conn, $_POST['username']);
        // $password=md5($_POST['password']);
        $password=mysqli_real_escape_string(md5($_POST['password']));
         //2.crate the sql to check whether the user name and password exist or not
         $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
         //3.Execute the query
         $res = mysqli_query($conn, $sql);
        //4.Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);
        if($count == 1){
            //user abailable and login success
            $_SESSION['login'] = "<div class='success'>Login successful. </div>";
            $_SESSION['user'] = $username; // to check whether the user is logged in or not and logout will unset it 
            //redict to home page
            header("location:".SITEURL."/admin/index.php");
        }else{
            //user not available
            $_SESSION['login'] = "<div class='error text-center'>Username or Password do not match </div>";
            //redict to home page
            header("location:".SITEURL."/admin/login.php");
        }
    }
?>