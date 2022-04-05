<?php include('partials/menu.php');?>

<div class="main-content"> 
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/><br/>

        <?php
            if(isset($_SESSION['add'])){ // checking whether the session is set or not
                echo $_SESSION['add'];//display the session message
                unset($_SESSION['add']);//remove the session message
            }
        ?>
        <form action="" method="POST"> 
            <table class="tbl-30">
                <tr>
                    <td>
                        Full Name: 
                    </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>
                        Username: 
                    </td>
                    <td><input type="text" name="username" placeholder="Your Username"></td>
                </tr>

                <tr>
                    <td>
                        Password: 
                    </td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php');?>

<?php
    // proess the value fomr form and save it in database
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        //1. get the data fom the form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encryption with MD5

        //2.sql query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";
        
        
        //3.execute query and save data in database. 
        // $conn = mysqli_connect('localhost', 'root', '1111233569', 'food-order', '3307') or die(mysqli_error()); //database connection----- solve the problem using SET PASSWORD FOR 'root'@'localhost' = PASSWORD('1111233569');
        // echo "connection success";
        // $db_select = mysqli_select_db($conn, 'food-order') or die(mysqli_error()); //selct database 
        $res = mysqli_query($conn, $sql) or die(mysqli_error()); //res will be true or false
        echo $res;
        //4.check whether the data is inserted or not and display appropriate message
        if($res == TRUE){
            // echo "data inserted";
            //create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            //redirect page
            header("location:".SITEURL.'/admin/manage-admin.php');
        }else{
            // echo "fail to insert data";
            //create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to Added Successfully</div>";
            //redirect page
            header("location:".SITEURL.'/admin/add-admin.php');
        }

        
    }

?>