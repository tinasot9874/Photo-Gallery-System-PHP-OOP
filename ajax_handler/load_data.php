<?php require_once("../admin/core/init.php");

$output = '';
$photo_id = '';
sleep(1);
$sql = "SELECT * FROM photos WHERE id > " . $_POST['last_photo_id'] . " LIMIT 4";
$photo_ajax = Photo::find_by_query($sql);
?>
            <?php foreach ($photo_ajax as $value): ?>
                        <div class="col-md-3 ftco-animate" title="<?php $cate_title = Category::find_by_id($value->categories_id);
                                                                echo $value->title . "," . $cate_title->category_name;
                                                                ?>">
                            <a href="<?php echo "admin" . DS . $value->picture_path(); ?>"
                               class="photography-entry img image-popup d-flex justify-content-center align-items-center"
                               style="background-image: url(admin/images/thumbnail/<?php echo $value->filename; ?>);">
                                <div class="overlay"></div>
                                <div class="text text-center">
                                    <h3></h3>
                                </div>
                            </a>
                        </div>
                        <?php $photo_id = $value->id;  ?>

            <?php endforeach; ?>
<?php

    $output .= '  
               <div class="btn_more" id="remove_row">
                        <button type="button" name="btn_more" data-vid="' . $photo_id . '" id="btn_more" class="btn btn-info">load more</button>
                    </div>  
     ';
    echo $output;

