<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/calendar.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Calendar($db);

    $meetings = $items->getMeetings();
    $itemCount = $meetings->rowCount();



    if($itemCount > 0){
        
        $meetingArr = array();
        $meetingArr["body"] = array();
        $meetingArr["itemCount"] = $itemCount;


        while ($row = $meetings->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $e = array(
                "id" => $id,
                "title" => $title,
                "joineeName" => $name,
                "duration" => $duration,
                "url" => "www.meetinglink.com/".base64_encode($id)
            );

            array_push($meetingArr["body"], $e);
        }
        echo json_encode(
            array("status"=>"Success","message" => $itemCount." record found.", "data" =>$meetingArr)
        );
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("status"=>"Failure","message" => "No record found.")
        );
    }
?>