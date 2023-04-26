<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/users.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new User($db);

    $data = json_decode(file_get_contents("php://input"));
    if(!empty($data->name) && !empty($data->email) ){

        $item->name = $data->name;
        $item->email = $data->email;
        $item->age = $data->age;
        $item->created_on = date('Y-m-d H:i:s');
        
        if($item->createUser()){
            http_response_code(201);
            echo json_encode(array("status"=>"Success", "message" => "User created successfully.", "data" =>$data));
        } else{
            http_response_code(503);
            echo json_encode(array("status"=>"Failure", "message" => "Something went wrong."));
        }
    }else{
        http_response_code(400);
        echo json_encode(array("status"=>"Failure", "message" => "Name and emails are required."));

    }
?>