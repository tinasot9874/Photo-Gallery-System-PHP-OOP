<?php


class Category extends Db_object
{
    protected static $db_table = "categories";
    protected static $db_table_fields = array('category_name', 'cate_slug');
    public $id;
    public $category_name;
    public $cate_slug;
}