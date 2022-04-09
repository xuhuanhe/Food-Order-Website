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
            if(isset($_SESSION['upload'])){ // checking whether the session is set or not
                echo $_SESSION['upload'];//display the session message
                unset($_SESSION['upload']);//remove the session message
            }
        ?>
        <!-- Add category form starts -->
        <!-- enctype="multipart/form-data" for uploading images -->
        <form action="" method="POST" enctype="multipart/form-data"> 
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
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

                //check whether the image is selected or not and set the value for image name accordingly
                // print_r($_FILES['image']); //using print_r because echo doesn't display the value of array and $_FILES is a array
                // die();//break the code here
                if(isset($_FILES['image']['name'])){//if out input type whose name is image has a name value
                    //upload the image
                    //to upload image we need image name. source path and destination path
                    $image_name = $_FILES['image']['name'];
                    //auto rename our image
                    //get the extention of our image(ipg, png, gif, etc) e.g. "special.food1.jpg"
                    $ext = end(explode('.', $image_name));

                    //rename the image
                    $image_name = "Food_category_".rand(000,999).'.'.$ext; //e.g. Food_category_834.jpg

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;

                    //Finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether the image is uploaded or not 
                    //and if the image is not uploaded then we will stop the process and redirect with error message
                    if($upload == false){
                        //set message
                        $_SESSION['upload']="<div class='error'>Failed to upload image. </div>";
                        //redirect to add category page
                        header("location:".SITEURL.'/admin/add-category.php');
                        //stop the process
                        die();
                    }

                }else{
                    //don't upload image and set the image_name value as blank
                    $image_name="";
                }

                //2.create sql query to insert category into database
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
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