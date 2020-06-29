<?php require_once("../admin/core/init.php");

if (isset($_GET['offset']) && isset($_GET['limit'])){
    $limit  = $_GET['limit'];
    $offset = $_GET['offset'];
    $sql = "SELECT * FROM photos LIMIT {$limit} OFFSET {$offset} ";
    $photo = Photo::find_by_query($sql);
}
?>

<?php foreach ($photo as $value): ?>
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
<?php endforeach; ?>