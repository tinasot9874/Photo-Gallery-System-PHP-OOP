
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Blank Page
            <small>Subheading</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Blank Page
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body" style="padding: 25px 150px 25px 50px;">
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
                        <div class="form-group">
                            <label for="title">Edit Title</label>
                            <input type="text" class="form-control" name="title" placeholder="John"
                                   value="<?php echo $photo->title; ?>">
                        </div>
                        <div class="form-group">
                            <label for="category">Edit Category</label>
                            <select class="custom-select mr-sm-2 form-control" name="cate">
                                <option value="<?php echo $cate->id; ?>" selected >
                                    <?php

                                    echo $cate->category_name;
                                    ?>
                                </option>
                                <?php
                                $categories = Category::find_all_except_by($photo->categories_id);
                                foreach ($categories as $value) {
                                    echo "<option value='" . $value->id . "'>" . $value->category_name . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group float-right">
                        <button style="float:right;" type="submit" name="update_photo" class="btn btn-primary "><i class="fa fa-fw fa-check"></i> Update Photo </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div align="center">
                <div class="form-group">
                    <img style="width: 100%; object-fit: contain;" id="preview" src="<?php echo $photo->picture_path(); ?>" alt="" class="border-0">
                </div>

            </div>
        </div>
        <hr>
    </div>
</div>