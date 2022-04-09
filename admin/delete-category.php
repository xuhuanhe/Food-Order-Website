<?php 
    //include constants file
    include('../config/constants.php');
    // echo "Delete Page";
    //check whether the id and image_name value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        //get the value and delete
        // echo "get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file is available 
        if($image_name != ""){
            //image is available. so remove it
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path); //unlink() delete a file and return true or false base on the result

            //if failed to remove image then add an error message and stop the process
            if($remove == false){
                //set the session message 
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                //redirect to manage category page
                header('location'.SITEURL.'/admin/manage-category.php');
                //stop the process
                die();
            }
        }
        //delete data from database 
        //sql query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        
        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the data is delete from database or not
        if($res== true){
            //set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully. </div>";
            //redirect 
            header("location:".SITEURL.'/admin/manage-category.php');
        }else{
            //set fail message and redirec
            $_SESSION['delete'] = "<div class='error'>Failed to delete Category. </div>";
            //redirect to manage category
            header("location:".SITEURL.'/admin/manage-category.php');
        }

        //redirect to manage category page with message

    }else{
        //redirect to manage category page
        header('location:'.SITEURL.'/admin/manage-category.php');
    }
?>