<?php
    //include constant.php for SITEURL
    include('../config/constants.php');
    //1.destroy the session
    session_destroy();//unsets $_SESSION['user']
    //2.redict to login page
    header('location:'.SITEURL.'/admin/index.php');
    
?>