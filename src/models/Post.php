<?php

class Post
{
    public $id;
    public $category_id;
    public $title;
    public $body;
    public $author;

    public function __construct($id=null,$category_id=null,$title=null,$body=null,$author=null){
        $category_id ? $this->category_id=$category_id : null;
        $id ? $this->id=$id : null;
        $title ? $this->title=$title : null;
        $body ? $this->body=$body : null;
        $author ? $this->author=$author : null;
    }

}