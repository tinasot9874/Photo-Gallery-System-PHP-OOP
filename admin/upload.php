<?php include("includes/header.php"); ?>
<?php
$message = "";
if (isset($_POST['uploads_image'])) {

    $photo = new Photo();

    $photo->title = $_POST['title'];
    //$photo->categories_id = $_POST['cate'];
    $photo->set_file($_FILES['file_upload']);

    if ($photo->save()){
        $message = "Photo Upload Successfully!";
    }else{
        $message = join("<br>", $photo->errors);
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
                        Upload Photo Page
                        <small>List</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Uploads Page
                        </li>
                    </ol>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row text-center">
                        <p><?php echo $message; ?></p>
                    </div>
                    <div class="container">
                        <div class="row">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                  enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="title" id="title" tabindex="1" class="form-control"
                                               placeholder="Title Image" value="">
                                    </div>
                                    <div class="form-group">
                                        <select class="custom-select mr-sm-2 form-control" name="cate">
                                            <option selected disabled>Select Categories</option>
                                            <?php
                                            $categories = Category::find_all();
                                            foreach ($categories as $value) {
                                                echo "<option value='" . $value->id . "'>" . $value->category_name . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group text-center">
                                        <h5>Choose images to uploads</h5>
                                        <span class="btn btn-primary btn-file">Browse file <input type="file"
                                                                                                  name="file_upload"
                                                                                                  onchange="readURL(this);"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="uploads_image" id="uploads_image" tabindex="1"
                                               class="form-control btn btn-primary btn-file" value="Uploads">
                                    </div>
                                </div>
                            </form>
                            <div class="preview col-md-6">

                                <div class="form-group">
                                    <img id="preview" src="" alt="" class="border-0">
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->


    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>