<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/users.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new User($db);

    $users = $items->getUsers();
    $itemCount = $users->rowCount();



    if($itemCount > 0){
        
        $userArr = array();
        $userArr["body"] = array();
        $userArr["itemCount"] = $itemCount;

        while ($row = $users->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "age" => $age,
                "created_on" => $created_on
            );

            array_push($userArr["body"], $e);
        }
        echo json_encode(
            array("status"=>"Success","message" => $itemCount." record found.", "data" =>$userArr)
        );
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("status"=>"Failure","message" => "No record found.")
        );
    }
?>