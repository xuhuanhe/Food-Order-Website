<?php include('partials/menu.php');?>

        <!-- main content section -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage catagory</h1>
                <br/><br/>
                <?php
                    if(isset($_SESSION['add'])){ // checking whether the session is set or not
                        echo $_SESSION['add'];//display the session message
                        unset($_SESSION['add']);//remove the session message
                    }
                ?>
                <br><br>
                <!-- button to add admin -->
                <a href="<?php echo SITEURL;?>/admin/add-category.php" class="btn-primary">Add Category</a>
                <br/><br/><br/>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full time</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td>Xuhuan He</td>
                        <td>xuhuanhe</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Xuhuan He</td>
                        <td>xuhuanhe</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Xuhuan He</td>
                        <td>xuhuanhe</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <!-- footer section  -->
<?php include('partials/footer.php');?>