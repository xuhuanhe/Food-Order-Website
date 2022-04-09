<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
            if(isset($_SESSION['add'])){ // checking whether the session is set or not
                echo $_SESSION['add'];//display the session message
                unset($_SESSION['add']);//remove the session message
            }
        ?>
        <!-- Add category form starts -->
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Feature: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category form ends -->

        <?php
            //check whether the submit button is clicked or not
            if(isset($_POST['submit'])){
                // echo "clicked";
                //1.get the value from category form
                $title = $_POST['title'];

                //for radio input, we need to check whether the button is selected or not
                if(isset($_POST['featured'])){
                    //get the value from form
                    $featured = $_POST['featured'];
                }else{
                    //set the default value
                    $featured="No";
                }
                if(isset($_POST['active'])){
                    //get the value from form
                    $active = $_POST['active'];
                }else{
                    //set the default value
                    $active="No";
                }

                //2.create sql query to insert category into database
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    featured='$featured',
                    active='$active'
                ";
                
                //3.execute the query and save in databse
                $res= mysqli_query($conn, $sql);
                //4.check whether the query executed or not and data added or not
                if($res == true){
                    //query executed and category added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                    //redirect page
                    header("location:".SITEURL.'/admin/manage-category.php');
                }else{
                    // failed to add category
                    $_SESSION['add'] = "<div class='error'>Failed to Added Category</div>";
                    //redirect page
                    header("location:".SITEURL.'/admin/manage-category.php');

                }



            }
        ?>

    </div>
</div>

<?php include('partials/footer.php');?>