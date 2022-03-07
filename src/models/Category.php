<?php

class Category
{
    public $id;
    public $name;

    public function __construct($id=null,$name=null){
        $id ? $this->id=$id : null;
        $name ? $this->name=$name : null;
    }
}