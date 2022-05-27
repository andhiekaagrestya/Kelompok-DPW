<?php 
  // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../moduls/Product.php';

  // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

  // Instantiate blog post object
    $post = new Post($db);

  // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $post->id = $data->id;
    $post->name = $data->name;
    $post->amount = $data->amount;
    $post->price = $data->price;

  // Create post
    if($post->update()) {
        echo json_encode(
            array('message' => 'Post Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Post Not Updated')
        );
    }
