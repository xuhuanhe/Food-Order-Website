<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl_30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <!-- drop down -->
                        <select name="category" id="">
                            <?php
                                //create PHP code to display categories from database
                                //1.create sql to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='yes'";
                                //executing query
                                $res = mysqli_query($conn, $sql);
                                //count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);
                                //if count is greater than zero, we have categories else we don't have category
                                if($count > 0){
                                    //we have categories
                                    while($row=mysqli_fetch_assoc($res)){
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title?></option>
                                        <?php
                                    }
                                }else{
                                    //we don't have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                                //2.display on dropdown

                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php
            //check whether the button is clicked or not
            if(isset($_POST['submit'])){
                //add the food in database
                // echo "clicked";
                //1.get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                //check whether radion button for featured and active are checked or not
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    $featured = "No";//setting the default value
                }
                if(isset($_POST['active'])){
                    $featured = $_POST['active'];
                }else{
                    $featured = "No";//setting the default value
                }
                //2. upload the image if selected
                //check whether the select image is clicked or not and upload the image only if the image is selectd
                if(isset($_FILES['image']['name'])){
                    //get the details of the selected image 
                    $image_name = $_FILES['image']['name'];
                    //check whether the image is selected or not and upload image only if selected
                    if($image_name!=""){
                        //image is selected
                        //A. rename the image 
                        //get the extension of selected image(jpg, png, gif, etc.) 
                        $ext = end(explode('.', $image_name));

                        //create new name for image
                        $image_name = "Food_Name_".rand(000, 999).".".$ext;
                        //B. upload the image
                        //get the src path and destination path


                        //source path is the current locaiton of the image 
                        $src = $_FILES['image']['tmp_name'];

                        //destination path for the image to be unlopaded
                        $dst = "../images/food/".$image_name;

                        //finally uppload the food image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image uploaded or not
                        if($upload == false){
                            //failed to upload the image
                            //redirect to add food page with error message
                            $_POST['upload'] = "<div class='error'> failed to upload image. </div>";
                            header('location:'.SITEURL.'/admin/add-food.php');
                            //stop the process
                            die();// if we failed to upload the image we don't want all the data saved into database

                        }
                    }
                }else{
                    $image_name = "";//setting deefault value as blank
                }
                //3.insert into databse

                //create a sql query to save oradd food
                //for numerical we don't need to pass value inde quotes '' but for string value it is compulsory to add quotes
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'

                ";
                // execute the query
                $res2 = mysqli_query($conn, $sql2);
                //chek whether data inserted or not
                if($res2 == true){
                    //data inserted successfully
                    $_SESSION['add'] = "<div class='success'>food added successfully. </div>";
                    header('location:'.SITEURL.'/admin/manage-food.php');
                }else{
                    //failed to insert data
                    $_SESSION['add'] = "<div class='error'>food added successfully. </div>";
                    header('location:'.SITEURL.'/admin/manage-food.php');
                }
                //4.redirect with message to manage food page
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php');?>