<?php
    include('../config/constants.php');
    //echo"delete food page";
    if(isset($_GET['id']) && isset($_GET['image_name'])){//eight
        //process to delete
        // echo "process to delte";
        //1.get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2.Remove the image if available
        //check whether the image is available or not and delete only if avaialbe
        if($image_name != ""){
            //it has image and need to remove from folder
            //get the image path
            $path = "../images/food/".$image_name;
            //remove image file from folder
            $remove = unlink($path);
            //check whether the image is removed or not
            if($remove==false){
                //failed to remove image 
                $_SESSION['upload'] = "<div class='error'>Failed to remove image file.</div>";
                //reidrect to mange food
                header('location:'.SITEURL.'/admin/manage-food.php');
                //stop the process of deleting food
                die();
            }
        }
        //3. delete food from database
        $sql = "DELETE FROM tbl_food WHERE id = $id";
        //Execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query executed or not and set the session message respectively
        if($res == true){
            //food deleted
            $_SESSION['delete'] = "<div class='success'>Food deleted successfully. </div>";
            header('location:'.SITEURL.'/admin/manage-food.php');
        }else{
            $_SESSION['delete'] = "<div class='error'>Food fail to deleted. </div>";
            header('location:'.SITEURL.'/admin/manage-food.php');
        }
    }else{
        //redirect to manage food page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized access. </div>";
        header('location:'.SITEURL.'/admin/manage-food.php');
    }
?>