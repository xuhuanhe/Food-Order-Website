<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <form action="" method="" enctype="multipart/form-data">
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
    </div>
</div>
<?php include('partials/footer.php');?>