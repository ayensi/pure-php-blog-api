<?php

include_once './models/Post.php';

class PostRepository
{
    private $conn;

    public function __construct($db){
        $this->conn=$db;
    }

    public function get(){
        $query = 'SELECT 
        c.name as category_name, 
        p.id, 
        p.category_id, 
        p.title, 
        p.body, 
        p.author, 
        p.created_at
        FROM posts p
        LEFT JOIN 
            categories c ON p.category_id = c.id
        ORDER BY p.created_at DESC';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }
    public function store(Post $post){
        $query = 'INSERT INTO posts(category_id,title,body,author) 
                    VALUES (:category_id,:title,:body,:author)
';
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':category_id', $post->category_id);
        $stmt->bindValue(':title', $post->title);
        $stmt->bindValue(':body', $post->body);
        $stmt->bindValue(':author', $post->author);
        try{
            if($stmt->execute()){
               $this->conn->commit();
            }
            else{
                $this->conn->rollback();
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }


    }
    public function update(Post $post){

        $query = 'UPDATE posts SET ';
        if($post->category_id) $query = $query . 'category_id = :category_id';
        if($post->title) $query = $query . 'title = :title';
        if($post->body) $query = $query . 'body= :body';
        if($post->author) $query = $query . 'author = :author';
        $query = $query . ' WHERE id = :id';
        echo $query;
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $post->id);
        if($post->category_id) $stmt->bindValue(':category_id', $post->category_id);
        if($post->title) $stmt->bindValue(':title', $post->title);
        if($post->body) $stmt->bindValue(':body', $post->body);
        if($post->author) $stmt->bindValue(':author', $post->author);

        try{
            if($stmt->execute()){
                $this->conn->commit();
            }
            else{
                $this->conn->rollback();
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }

    }
    public function destroy($id){
        $query = 'DELETE FROM posts WHERE id=:id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

    }
}