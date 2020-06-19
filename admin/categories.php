<?php include("includes/header.php"); ?>
<?php
$message = "";
if (isset($_POST['add_cate'])) {

    $cate = new Category();
    $cate->category_name = $_POST['cate_title'];
    $cate->cate_slug = $_POST['cate_slug'];
    if ($cate->save()){
        $message = "Add Category Successfull";
    }else{
        $message = "Cant add category, something is wrong!";
    }
}

?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <?php include("includes/top_nav.php"); ?>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php include("includes/side_nav.php"); ?>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Category Page
                        <small>List</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Category Page
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row"><p><?php echo $message; ?></p></div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <h3>Add Category</h3>
                    <form action="" method="post">
                        <div class="form-body">
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Add Category</label>
                                        <input type="text" id="cate_title" name="cate_title"  class="form-control" placeholder="" required onkeyup="ChangeToSlug();"> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tên slug</label>
                                        <input type="text" id="cate_slug" name="cate_slug" class="form-control" placeholder="" readonly required> </div>
                                </div>
                            </div>
                            <!--/row-->
                            <hr>
                            <div class="form-actions m-t-40" style="text-align: center;">
                                <button name="add_cate" type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Add</button>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="col-lg-6 col-md-6">
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="col-md-12">
                                <div class="row" style=" margin-bottom: 25px; margin-top: 25px;">
                                    <div class="col-md-6">
                                        <input class="form-control" id="myInput" type="text" placeholder="Search Category">
                                    </div>
                                </div>
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Category name</th>
                                        <th>Category Slug</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    <?php $cate = Category::find_all();
                                    foreach ($cate as $value):
                                        ?>
                                        <tr>
                                            <td><?php echo $value->category_name; ?></td>
                                            <td><?php echo $value->cate_slug; ?></td>
                                            <td>
                                                <a href="delete.php?cate=<?php echo $value->id; ?>" style="cursor: pointer;" class="delete" title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                           </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div> <!--First Row-->

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>