<?php
include_once './models/Category.php';

class CategoryRepository
{
    private $conn;

    public function __construct($db){
        $this->conn=$db;
    }

    public function get(){
        $query = 'SELECT 
        c.id, 
        c.name, 
        FROM categories c
        ORDER BY p.created_at DESC';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;

    }
    public function store(Category $category){
        $query = 'INSERT INTO categories(name) 
                    VALUES (:name)
';
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':name', $category->name);
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
    public function update(Category $category){

        $query = 'UPDATE categories SET ';
        if($category->name) $query = $query . 'name = :name';
        $query = $query . ' WHERE id = :id';
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $category->id);
        if($category->name) $stmt->bindValue(':name', $category->name);

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
        $query = 'DELETE FROM categories WHERE id=:id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

    }
}