<?php include('partials/menu.php');?>

        <!-- main content section -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage food</h1>

                <br/><br/>
                <!-- button to add admin -->
                <a href="<?php echo SITEURL.'/admin/add-food.php';?>" class="btn-primary">Add Food</a>
                <br/><br/><br/>

                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                ?>

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