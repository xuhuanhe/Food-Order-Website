<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id'])){
                $id=$_GET['id'];
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name = "current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    //check whether the submit button is check or not
    if(isset($_POST['submit'])){
        // echo "click";
        //1.get the data from form
        $id=$_POST['id'];
        $current_password= md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        // 2.check whether the user with current id and crrent password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password='$current_password'";

        //Execute the query
        $res = mysqli_query($conn, $sql);
        if($res == true){
            //check whether data is available or not
            $count = mysqli_num_rows($res);

            if($count == 1){
                //user exists and password can be change
                // echo "user found ";
                //check whether the new password and confirm match or not
                if($new_password == $confirm_password){
                    //update the password
                    $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password'
                        WHERE id = $id
                    ";
                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //check whether the query executed or not
                    if($res == true){
                        //display the message 
                        $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully. </div>";
                        //redirect to admin page with success message
                        header("location:".SITEURL."/admin/manage-admin.php");
                    }else{
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to change password. </div>";
                        //redirect
                        header("location:".SITEURL."/admin/manage-admin.php");
                    }
                }else{
                    //redirect to manage admin page with error message
                    //user does not exist 
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password not Match. </div>";
                    //redirect
                    header("location:".SITEURL."/admin/manage-admin.php");
                }
            }else{
                //user does not exist 
                $_SESSION['user-not-found'] = "<div class='error'>User not found or password is not correct. </div>";
                //redirect
                header("location:".SITEURL."/admin/manage-admin.php");
            }
        }
        // 3.check whether the new password and confirm password match or not 

        //4.change whether if all above is true

    }
?>


<?php include('partials/footer.php');?>