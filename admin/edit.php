<?php include("includes/header.php"); ?>

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
            <?php
            if (isset($_GET['edit_photo'])) {
                $photo = Photo::find_by_id($_GET['edit_photo']);
                if ($photo){
                    $cate = Category::find_by_id($photo->categories_id);
                    if (isset($_POST['update_photo'])){
                        $photo->title = $_POST['title'];
                        $photo->categories_id = $_POST['cate'];
                        $photo->save();
                        redirect($_SERVER['REQUEST_URI']);
                    }
                    include("includes/photo_edit.php");
                }else{
                    redirect('404.html');
                }
            }else{
                redirect('photos.php');
            }
            ?>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>