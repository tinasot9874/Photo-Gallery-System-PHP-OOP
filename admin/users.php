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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Users Page
                        <small>List</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Users Page
                        </li>
                    </ol>
                </div>
            </div>
            <hr>
            <!-- /.row -->
            <div class="row">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="col-md-12">
                            <div class="row" style=" margin-bottom: 25px; margin-top: 25px;">
                                <div class="col-md-3">
                                    <input class="form-control" id="myInput" type="text" placeholder="Search User">
                                </div>
                            </div>
                            <div class="table-responsive">
                            <div style="width: 100%; height:350px; overflow:auto;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Nums-of-Photo</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                </tr>
                                </thead>
                                <tbody id="myTable">
                                <?php $user = User::find_all();
                                foreach ($user as $value):
                                    ?>
                                    <tr>
                                        <td><img style="width:100px;height: 100px;object-fit: contain; "
                                                 src="<?php echo $value->default_avatar(); ?>" alt=""></td>
                                        <td><?php echo $numofphoto = Photo::count_photo_by_user_id($value->id); ?></td>
                                        <td><?php echo $value->username; ?></td>
                                        <td><?php echo $value->first_name; ?></td>
                                        <td><?php echo $value->last_name; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php if ($value->status == 0) {
                                                echo "<span class='label label-success'> Active </span>";
                                            } else {
                                                echo "<span class='label label-danger'> Suspented </span>";
                                            } ?></td>
                                        <td><?php if ($value->role == 1) {
                                                echo "<span class='label' style='background-color: #fec107; '> Admin </span>";
                                            } else {
                                                echo "<span class='label label-info' '> Member </span>";
                                            } ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>

                            </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->


    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>