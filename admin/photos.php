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
            <div class="col-md-12">
            <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Photos Page
                            <small>List</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Photos Page
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-8"></div>
                                <div class="col-sm-4">
                                    <a href="upload.php" type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row" style="margin-bottom: 25px; margin-top: 25px;">
                                <div class="col-md-3">
                                    <input class="form-control" id="myInput" type="text" placeholder="Search Photo">
                                </div>
                            </div>
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>User Upload</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Size</th>
                                    <th>Day Upload</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="myTable">
                                <?php $photo = Photo::find_all();
                                foreach ($photo as $value):
                                ?>
                                <tr>
                                    <td><img style="width:200px;height: 100px;object-fit: contain; " src="<?php echo $value->picture_resize_path(); ?>" alt=""></td>
                                    <td><?php $user = User::find_by_id($value->user_id); echo $user->username;  ?></td>
                                    <td><?php echo $value->title; ?></td>
                                    <td><?php $category = Category::find_by_id($value->categories_id); echo $category->category_name;  ?></td>
                                    <td><?php echo $value->type; ?></td>
                                    <td><?php echo round($value->size / 1000000, 2); ?> Mb</td>
                                    <td><?php echo $value->create_at; ?></td>
                                    <td>
                                        <a href="edit.php?edit_photo=<?php echo $value->id; ?>" style="cursor: pointer;" class="edit" title="Edit" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                                        <a href="delete.php?photo=<?php echo $value->id; ?>" style="cursor: pointer;" class="delete" title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>