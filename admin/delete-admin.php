<?php

include('../config/constants.php');
//1.get the ID of admin to be deleted
$id = $_GET['id'];
//2.create sql query to delte admin
$sql = "DELETE FROM tbl_admin WHERE id = $id";
//execute the query
$res = mysqli_query($conn, $sql);
//check whether the query executed successfully or not
if($res == true){
    //query executed successfully and admin deleted
    // echo "Admin deleted";
    //create session variable to display message
    $_SESSION['delete'] = "Admin Deleted successfully";
    //redirect to manage admin page
    header('location:'.SITEURL.'/admin/manage-admin.php');
}else{
    //fail to delete admin
    // echo "failed to deleted admin";
    $_SESSION['delete'] = 'failed to deleted admin. try again later';
    header('location:'.SITEURL.'/admin/manage-admin.php');
}

//3.redirect to manage admin page with message(success/error)


?>