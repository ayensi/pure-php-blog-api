<?php
include_once 'config/Database.php';
include_once 'repository/PostRepository.php';
include_once 'repository/CategoryRepository.php';
include_once 'models/Post.php';
/* DB init
$db = new Database();
$conn = $db->connect();
*/

/* Repository Objects
$post = new PostRepository($conn);
$category = new CategoryRepository($conn);
*/

/* DELETE Category
$category->destroy(1);
 */

/* DELETE POST
$post->destroy($_POST['id']);
*/

/* UPDATE POST
$postTest = new Post(id:$_POST['id'],title:$_POST['title']);
$post->update($postTest);
*/

/* NEW POST
$postTest = new Post(category_id:$_POST['category_id'],title:$_POST['title'],body:$_POST['body'],author:$_POST['author']);
$post->store($postTest);
*/

/* GETTING POSTS FROM DB
$result = $post->get();
if($result->rowCount()>0){
    $posts = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' =>html_entity_decode($body),
            'author'=>$author,
            'created_at' =>$created_at,
            'category_id'=>$category_id,
            'category_name'=>$category_name
        );
        array_push($posts,$post_item);
    }
    echo json_encode($posts);

}*/