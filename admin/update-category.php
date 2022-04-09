<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
            //check whether the id is set or not
            if(isset($_GET['id'])){
                //get the id and all other details
                // echo "getting the data";
                $id = $_GET['id'];
                //create sql query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id = $id";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);
                if($count==1){
                    //get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }else{
                    //redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
                    header("location:".SITEURL."/admin/manage-category.php");
                }
            }else{
                //rediirect to manage category
                header("location:".SITEURL."/admin/manage-category.php");
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != ""){
                                //display the image
                                ?>
                                    <img src="<?php echo SITEURL;?>/images/category/<?php echo $current_image;?>" width=150px>
                                <?php
                            }else{
                                //display message
                                echo "<div class='error'>Image not added. </div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <!-- the checked is html property. it will mark in our radio button -->
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";}?>type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?>type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?>type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('partials/footer.php');?>